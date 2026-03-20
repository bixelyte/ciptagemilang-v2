<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden min-h-[50vh] flex items-center bg-fixed bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/backgrounds/bg_clients.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-[2px]"></div>
    
    <div class="relative z-10 mx-auto w-full max-w-[1440px]">
      <div class="flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/80 px-4 py-2 rounded-sm border border-primary/20 backdrop-blur-md">
          {{ __('PARTNERING WITH INDUSTRY LEADERS') }}
        </span>
        <h1 class="mt-2 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">
          {{ __('OUR CLIENTS') }}
        </h1>
        <p class="mt-6 max-w-2xl text-white/80 text-base md:text-lg font-light leading-relaxed">
          {{ __('We are proud to work with some of the most recognized brands in Indonesia, delivering exceptional engineering and construction solutions.') }}
        </p>

        <!-- Breadcrumbs -->
        <nav class="mt-10 flex items-center justify-center space-x-2 text-sm font-medium text-white/50 backdrop-blur-md bg-background-dark/50 px-6 py-3 rounded-full border border-white/10">
          <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">home</span>
            {{ __('Home') }}
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <span class="text-white">{{ __('Clients') }}</span>
        </nav>
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
                <span class="material-symbols-outlined text-sm">open_in_new</span> {{ __('Visit Website') }}
              </a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
</div>
