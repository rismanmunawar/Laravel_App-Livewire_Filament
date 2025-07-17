<?php

namespace App\Filament\Pages;

use App\Imports\MonitoringImport;
use App\Models\DataDist;
use App\Models\monitoring_zndsu;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class MonitoringUpload extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static string $view = 'filament.pages.monitoring-upload';
    protected static ?string $navigationLabel = 'Upload Monitoring';
    protected static ?string $title = 'Upload Monitoring Data';
    protected static ?string $navigationGroup = 'Monitoring';

    public $file;
    public $uploaded_at;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')
                ->label('Upload Excel File (.xls/.xlsx)')
                ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->required()
                ->disk('local'),

            Forms\Components\DatePicker::make('uploaded_at')
                ->default(now())
                ->required(),
        ];
    }

    public function mount(): void
    {
        $this->form->fill([
            'uploaded_at' => now(),
        ]);
    }

    public function submit()
    {
        $data = $this->form->getState();

        $path = $data['file'];
        $file = Storage::disk('local')->path($path);

        monitoring_zndsu::truncate();
        $import = new MonitoringImport();
        Excel::import($import, $file);
        $sheet = $import->rows;

        $user = Auth::user();
        $uploadedAt = $data['uploaded_at'];
        $dateColumns = $sheet->first()?->keys()?->filter(fn($key) => preg_match('/^\d{2}$/', $key)) ?? [];

        foreach ($sheet as $row) {
            $plant = trim(strtoupper($row['plants'] ?? ''));
            $name = $row['plant_name'] ?? null;
            if (!$plant || !$name) continue;

            $masterDistId = DataDist::whereRaw('UPPER(TRIM(plant)) = ?', [$plant])->value('id');
            $masterItId = null;

            $rowData = [
                'user_id' => $user->id,
                'plant' => $plant,
                'name_dist' => $name,
                'uploaded_at' => $uploadedAt,
                'master_it_id' => $masterItId,
                'master_dist_id' => $masterDistId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $hasError = false;

            foreach ($dateColumns as $day) {
                $raw = strtoupper(trim((string)($row[$day] ?? '')));
                $status = match (true) {
                    str_contains($raw, '@0V@') => 'done',
                    str_contains($raw, '@02@') => 'error',
                    str_contains($raw, '@3O@'), $raw === '' => 'libur',
                    default => 'libur',
                };

                if ($status === 'error') $hasError = true;

                $dayKey = 'day_' . str_pad($day, 2, '0', STR_PAD_LEFT);
                $rowData[$dayKey] = $status;
            }

            $rowData['has_error'] = $hasError;
            monitoring_zndsu::create($rowData);
        }

        Notification::make()
            ->title('Upload Berhasil')
            ->body('Data berhasil diupload dan disimpan.')
            ->success()
            ->send();
    }
}
