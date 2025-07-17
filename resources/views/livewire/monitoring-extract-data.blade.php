<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="mt-4 flex items-center space-x-3">
            <x-filament::button type="submit" wire:target="submit" wire:loading.attr="disabled">
                Upload
            </x-filament::button>

            <div wire:loading wire:target="submit" class="text-sm text-gray-500">
                <x-filament::icon name="heroicon-o-arrow-path" class="animate-spin w-5 h-5 inline-block" />
                Proses upload sedang berjalan...
            </div>
        </div>
    </form>
</x-filament::page>