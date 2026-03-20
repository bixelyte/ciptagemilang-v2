<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-20 flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-end">
        <div class="max-w-2xl relative">
          <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/60 px-3 py-1.5 rounded-sm">{{ __('What We Do') }}</span>
          <h1 class="mt-4 text-5xl font-black uppercase tracking-tighter lg:text-7xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('OUR SERVICES') }}</h1>
        </div>
        <div class="relative">
          <p class="max-w-md font-light text-white/60 text-sm pl-8 border-l border-primary">
            {{ __('Specialized solutions in Civil works, Mechanical-Electrical (ME), HVAC systems, and high-end Procurement for luxury commercial environments.') }}
          </p>
        </div>
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
