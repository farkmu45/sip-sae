<x-filament::widget>
  <x-filament::card>
    <h2 class="text-xl font-bold tracking-tight md:text-2xl mb-10">Narasi Terbaru</h2>

    @if ($narration)
      <div class="w-full h-80 rounded-md overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $narration->picture) }}" alt=""
          srcset="">
      </div>
      <h3 class="text-lg pt-5 font-semibold">{{ $narration->title }}</h3>

      <p>{{ $narration->content }}</p>

      <p class="pt-20 text-right">{{ $narration->created_at->diffForHumans() }}</p>
    @endif

  </x-filament::card>
</x-filament::widget>
