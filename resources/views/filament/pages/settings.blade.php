<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}
        <x-filament-panels::form.actions>
            <x-filament::button type="submit">
                Enregistrer
            </x-filament::button>
        </x-filament-panels::form.actions>
    </x-filament-panels::form>
</x-filament-panels::page>

{{-- ========================================== --}}
{{-- EN-TÊTE DE LA PAGE (HERO)                  --}}
{{-- ========================================== --}}
<div class="relative bg-blue-900 h-72 md:h-96 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800 opacity-90"></div>
    <div class="absolute inset-0 bg-[url('/public/images/pattern.png')] opacity-10 mix-blend-overlay"></div>
    