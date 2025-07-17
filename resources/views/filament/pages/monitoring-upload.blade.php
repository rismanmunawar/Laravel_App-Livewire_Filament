<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        {{-- Jarak atas untuk memisahkan tombol dari input form --}}
        <div class="mt-6 flex items-center space-x-4">
            {{-- Tombol Submit --}}
            <x-filament::button
                type="submit"
                wire:target="submit"
                wire:loading.attr="disabled">
                Upload
            </x-filament::button>

            {{-- Loading Indicator --}}
            <div
                wire:loading
                wire:target="submit"
                class="text-sm text-gray-500 flex items-center space-x-2">
                <x-filament::icon
                    name="heroicon-o-arrow-path"
                    class="animate-spin w-5 h-5 text-primary-600" />
                <span>Proses upload sedang berjalan...</span>
            </div>
        </div>
    </form>
</x-filament::page>