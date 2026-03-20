<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden min-h-[50vh] flex items-center bg-fixed bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/backgrounds/bg_services.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-[2px]"></div>
    
    <div class="relative z-10 mx-auto w-full max-w-[1440px]">
      <div class="flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/80 px-4 py-2 rounded-sm border border-primary/20 backdrop-blur-md">
          {{ __('What We Do') }}
        </span>
        <h1 class="mt-2 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">
          {{ __('OUR SERVICES') }}
        </h1>
        <p class="mt-6 max-w-2xl text-white/80 text-base md:text-lg font-light leading-relaxed">
          {{ __('Specialized solutions in Civil works, Mechanical-Electrical (ME), HVAC systems, and high-end Procurement for luxury commercial environments.') }}
        </p>

        <!-- Breadcrumbs -->
        <nav class="mt-10 flex items-center justify-center space-x-2 text-sm font-medium text-white/50 backdrop-blur-md bg-background-dark/50 px-6 py-3 rounded-full border border-white/10">
          <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">home</span>
            {{ __('Home') }}
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <span class="text-white">{{ __('Services') }}</span>
        </nav>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Services Grid --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
          <div class="group relative overflow-hidden rounded-xl bg-transparent p-10 transition-all thin-gold-border hover:bg-white/[0.04]">
            <div class="mb-8">
              <span class="material-symbols-outlined text-4xl gold-gradient-icon">{{ $service->icon }}</span>
            </div>
            <h3 class="mb-4 text-xl font-bold text-white group-hover:text-primary transition-colors">{{ $service->title }}</h3>
            <p class="text-sm font-light leading-relaxed text-white/50">{{ $service->short_description }}</p>
            @if ($service->description)
              <div class="mt-6 text-sm text-white/40 leading-relaxed prose prose-invert prose-sm max-w-none">
                {!! $service->description !!}
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CTA Section --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px] text-center">
      <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tighter text-white mb-6">{{ __('Need Our Services?') }}</h2>
      <p class="text-white/50 text-sm mb-12 max-w-lg mx-auto">
        {{ __('Get in touch with our team to discuss your project requirements and receive a tailored solution.') }}
      </p>
      <a href="{{ route('contact') }}" class="inline-flex h-10 md:h-14 items-center justify-center rounded-lg gold-solid-gradient-orange gradient-border-opposite bevel-effect px-4 text-xs md:px-10 md:text-sm font-extrabold uppercase tracking-wider text-background-dark shadow-2xl cta-start-project">
        {{ __('Start Your Project') }}
      </a>
    </div>
  </section>
</div>
