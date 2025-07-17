<div>
    <main class="bg-gray-50 min-h-screen">
        {{-- Header --}}
        <section class="bg-white py-6 shadow-sm">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Monitoring Extract Data</h2>
                <p class="text-gray-500 mt-2">Pantau status harian plant</p>
            </div>
        </section>

        {{-- Content --}}
        <section class="py-10">
            <div class="container-fluid px-5 py-4 space-y-6">
                {{-- Search and Error Count --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <input
                        type="text"
                        wire:model.live="search"
                        class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-100 focus:outline-none"
                        placeholder="Cari plant atau nama...">

                    <span class="inline-block bg-red-100 text-red-700 text-sm font-semibold px-4 py-2 rounded-full shadow">
                        Total Error: {{ $errorCount }}
                    </span>
                </div>
            </div>
            <div class="container-fluid px-5 py-4 space-y-6">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 mt-6">
                    <div class="min-w-[1200px]">
                        <table class="w-full whitespace-nowrap text-sm table table-bordered align-middle text-center">
                            <thead class="table-light sticky-top z-10">
                                <tr>
                                    <th class="bg-light sticky-left border-end text-dark fw-bold" style="left: 0; z-index: 2;">#</th>
                                    <th class="bg-light sticky-left border-end text-dark fw-bold text-start" style="left: 50px; z-index: 2;">Plant</th>
                                    <th class="text-dark">Nama Dist</th>
                                    <th class="text-dark">ROM</th>
                                    <th class="text-dark">PIC IT</th>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <th class="text-dark">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</th>
                                        @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($monitorings as $index => $item)
                                <tr>
                                    <td class="bg-white sticky-left border-end text-dark" style="left: 0; z-index: 1;">
                                        {{ ($monitorings->currentPage() - 1) * $monitorings->perPage() + $index + 1 }}
                                    </td>
                                    <td class="bg-white sticky-left border-end text-dark text-start fw-semibold" style="left: 50px; z-index: 1;">
                                        {{ $item->plant }}
                                    </td>
                                    <td class="text-dark text-start">{{ $item->name_dist }}</td>
                                    <td class="text-dark text-start">ROM</td>
                                    <td class="text-dark text-start">PIC</td>
                                    @for ($i = 1; $i <= 31; $i++)
                                        @php
                                        $key='day_' . str_pad($i, 2, '0' , STR_PAD_LEFT);
                                        $value=$item->$key;

                                        if ($value === 'done') {
                                        $icon = '<i class="fa-regular fa-circle-check"></i>';
                                        $color = 'text-success';
                                        } elseif ($value === 'error') {
                                        $icon = '<i class="fa-solid fa-triangle-exclamation"></i>';
                                        $color = 'text-warning';
                                        } elseif ($value === 'libur') {
                                        $icon = '<i class="fa-regular fa-circle-check"></i>';
                                        $color = 'text-secondary';
                                        } else {
                                        $icon = '<i class="fa-regular fa-circle"></i>';
                                        $color = 'text-muted';
                                        }
                                        @endphp
                                        <td class="px-2 py-1 border text-center">
                                            <span class="{{ $color }}">{!! $icon !!}</span>
                                        </td>
                                        @endfor

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="35" class="text-center text-muted py-4">Tidak ada data ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $monitorings->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
        </section>
    </main>

    <style>
        .shadow-right {
            box-shadow: 2px 0 4px -2px rgba(0, 0, 0, 0.05);
        }

        [x-cloak] {
            display: none;
        }

        table tbody tr:hover {
            background-color: #ebf8ff;
        }

        .pagination {
            @apply mt-4;
        }
    </style>
</div>