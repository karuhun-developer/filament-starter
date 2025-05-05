<x-filament-panels::page>
    <div class="grid">
        <form wire:submit="save">
            {{ $this->form }}

            <div class="flex justify-end mt-4">
                <x-filament::button type="submit" color="primary">
                    Save
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page>
