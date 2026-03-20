<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-12 flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/60 px-3 py-1.5 rounded-sm">Partnering with Industry Leaders</span>
        <h1 class="mt-4 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">OUR CLIENTS</h1>
        <p class="mt-6 max-w-lg text-white/50 text-sm">
          We are proud to work with some of the most recognized brands in Indonesia, delivering exceptional engineering and construction solutions.
        </p>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Clients Grid --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($clients as $client)
          <div class="group relative overflow-hidden rounded-xl bg-transparent p-10 transition-all thin-gold-border hover:bg-white/[0.04] text-center">
            <div class="mb-6 flex items-center justify-center h-20">
              @if ($client->logo)
                <img alt="{{ $client->name }}" class="max-h-16 object-contain opacity-60 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all" src="{{ Storage::url($client->logo) }}" />
              @else
                <span class="text-3xl font-black tracking-tighter text-white/60 uppercase group-hover:text-primary transition-colors">{{ $client->name }}</span>
              @endif
            </div>
            <h3 class="mb-2 text-lg font-bold text-white group-hover:text-primary transition-colors">{{ $client->name }}</h3>
            @if ($client->description)
              <p class="text-sm font-light leading-relaxed text-white/50 mb-4">{{ $client->description }}</p>
            @endif
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-primary/60">
              {{ $client->projects_count }} {{ Str::plural('project', $client->projects_count) }}
            </p>
            @if ($client->website)
              <a href="{{ $client->website }}" target="_blank" class="mt-4 inline-flex items-center gap-1 text-xs text-primary/60 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-sm">open_in_new</span> Visit Website
              </a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
</div>
