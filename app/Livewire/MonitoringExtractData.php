<?php

namespace App\Livewire;

use App\Models\DataDist;
use App\Models\monitoring_zndsu;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class MonitoringExtractData extends Component
{
    use WithFileUploads, WithPagination;

    public $search = '';
    public $uploaded_at;
    public $file;

    protected $queryString = ['search'];

    public function mount()
    {
        $this->uploaded_at = now()->format('Y-m-d');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetUploadForm()
    {
        $this->reset(['file']);
        $this->uploaded_at = now()->format('Y-m-d');
    }

    public function submitUpload()
    {
        $this->validate([
            'file' => 'required|file|mimes:xls,xlsx',
            'uploaded_at' => 'required|date',
        ]);

        // Hapus semua data lama
        monitoring_zndsu::truncate();

        // Import
        $import = new \App\Imports\MonitoringImport();
        Excel::import($import, $this->file);
        $sheet = $import->rows;

        $user = Auth::user();
        $uploadedAt = $this->uploaded_at;

        $dateColumns = $sheet->first()?->keys()?->filter(fn($key) => preg_match('/^\d{2}$/', $key)) ?? [];

        if ($dateColumns->isEmpty()) {
            session()->flash('error', 'Kolom tanggal (01-31) tidak ditemukan di Excel.');
            return;
        }

        foreach ($sheet as $row) {
            $plant = trim(strtoupper($row['plants'] ?? ''));
            $name = $row['plant_name'] ?? null;

            if (!$plant || !$name) continue;

            $masterDistId = DataDist::whereRaw('UPPER(TRIM(plant)) = ?', [$plant])->value('id');
            $masterItId = DataDist::where('name', 'LIKE', "%{$user->name}%")->value('id');

            if (!$masterDistId) continue; // skip jika tidak ketemu

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

                if ($status === 'error') {
                    $hasError = true;
                }

                $dayKey = 'day_' . str_pad($day, 2, '0', STR_PAD_LEFT);
                $rowData[$dayKey] = $status;
            }

            $rowData['has_error'] = $hasError;

            monitoring_zndsu::create($rowData);
        }

        session()->flash('success', 'Data has been successfully uploaded and saved.');
    }

    public function render()
    {
        $monitorings = monitoring_zndsu::with(['masterDist.its'])
            ->when($this->search, function ($query) {
                $query->where('plant', 'like', '%' . $this->search . '%')
                    ->orWhere('name_dist', 'like', '%' . $this->search . '%');
            })
            ->where('has_error', true)
            ->orderByDesc('uploaded_at')
            ->paginate(10);

        // Hitung total kemunculan "error" (status @02@ yang disimpan sebagai 'error' di day_01 s.d. day_31)
        $errorCount = monitoring_zndsu::select([
            DB::raw(collect(range(1, 31))->map(function ($i) {
                $col = 'day_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                return "SUM(CASE WHEN `$col` = 'error' THEN 1 ELSE 0 END)";
            })->implode(' + ') . ' AS total_error')
        ])->value('total_error');

        return view('livewire.monitor-extract.index', [
            'monitorings' => $monitorings,
            'errorCount' => $errorCount,
        ]);
    }
}
