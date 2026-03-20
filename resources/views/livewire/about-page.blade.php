<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-12 flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/60 px-3 py-1.5 rounded-sm">Who We Are</span>
        <h1 class="mt-4 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">ABOUT US</h1>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Company Description --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
          <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tighter text-white mb-8">{{ $companyName }}</h2>
          <p class="text-white/60 text-base leading-relaxed mb-8">{{ $aboutDescription }}</p>
        </div>
        <div class="flex items-center justify-center">
          <div class="grid grid-cols-2 gap-6">
            @foreach ($stats as $stat)
              <div class="flex flex-col items-center p-8 rounded-xl thin-gold-border bg-white/[0.02]">
                <span class="material-symbols-outlined text-4xl gold-gradient-icon mb-4">{{ $stat->icon }}</span>
                <span class="text-2xl font-black text-white leading-none mb-2">{{ $stat->value }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-primary text-center">{{ $stat->label }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Mission & Vision --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <div class="p-10 rounded-xl thin-gold-border bg-white/[0.02]">
          <div class="mb-6">
            <span class="material-symbols-outlined text-4xl gold-gradient-icon">flag</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Our Mission</h3>
          <p class="text-sm font-light leading-relaxed text-white/50">{{ $aboutMission }}</p>
        </div>
        <div class="p-10 rounded-xl thin-gold-border bg-white/[0.02]">
          <div class="mb-6">
            <span class="material-symbols-outlined text-4xl gold-gradient-icon">visibility</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Our Vision</h3>
          <p class="text-sm font-light leading-relaxed text-white/50">{{ $aboutVision }}</p>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px] text-center">
      <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tighter text-white mb-6">Ready to Work Together?</h2>
      <p class="text-white/50 text-sm mb-12 max-w-lg mx-auto">
        Let's discuss how we can bring your project vision to life with our expertise and dedication.
      </p>
      <a href="{{ route('contact') }}" class="inline-flex h-10 md:h-14 items-center justify-center rounded-lg gold-solid-gradient-orange gradient-border-opposite bevel-effect px-4 text-xs md:px-10 md:text-sm font-extrabold uppercase tracking-wider text-background-dark shadow-2xl cta-start-project">
        Get in Touch
      </a>
    </div>
  </section>
</div>
