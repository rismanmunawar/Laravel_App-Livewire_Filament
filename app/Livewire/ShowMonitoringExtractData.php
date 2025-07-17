<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\monitoring_zndsu;
use Illuminate\Support\Facades\DB;

class ShowMonitoringExtractData extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil hanya baris yang memiliki minimal 1 kolom day_XX = 'error'
        $monitorings = monitoring_zndsu::query()
            ->where(function ($query) {
                foreach (range(1, 31) as $i) {
                    $col = 'day_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                    $query->orWhere($col, 'error');
                }
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('plant', 'like', "%{$this->search}%")
                        ->orWhere('name_dist', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('uploaded_at')
            ->paginate(10);

        $errorCount = monitoring_zndsu::select([
            DB::raw(collect(range(1, 31))->map(
                fn($i) => "SUM(CASE WHEN `day_" . str_pad($i, 2, '0', STR_PAD_LEFT) . "` = 'error' THEN 1 ELSE 0 END)"
            )->implode(' + ') . ' AS total_error')
        ])->value('total_error');

        return view('livewire.show-monitoring-extract-data', compact('monitorings', 'errorCount'));
    }
}
