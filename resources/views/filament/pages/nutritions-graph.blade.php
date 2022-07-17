<x-filament::page>
  <form wire:submit.prevent="submit">
    {{ $this->form }}

    <div class="flex justify-end mt-3">
        <x-filament::button type="submit">
          {{__('text.find')}}
        </x-filament::button>
    </div>
  </form>
</x-filament::page>
