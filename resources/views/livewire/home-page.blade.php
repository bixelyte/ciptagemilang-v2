<div>
  <style>
    .dir-next .bg-enter-start { transform: translateX(100%); }
    .dir-next .bg-leave-end { transform: translateX(-100%); }
    .dir-prev .bg-enter-start { transform: translateX(-100%); }
    .dir-prev .bg-leave-end { transform: translateX(100%); }
  </style>
  {{-- Hero Section (Carousel) --}}
  @if ($banners->isNotEmpty())
    <section
      x-data="{
        slide: 0,
        total: {{ $banners->count() }},
        timer: null,
        direction: 'next',
        next() { 
          this.direction = 'next';
          this.slide = (this.slide + 1) % this.total; 
        },
        prev() { 
          this.direction = 'prev';
          this.slide = (this.slide - 1 + this.total) % this.total; 
        },
        goTo(i) { 
          if (i === this.slide) return;
          this.direction = i > this.slide ? 'next' : 'prev';
          this.slide = i; 
        },
        startAutoSlide() {
          this.timer = setInterval(() => this.next(), 8000);
        },
        stopAutoSlide() {
          clearInterval(this.timer);
        },
        init() {
          this.startAutoSlide();
        }
      }"
      @mouseenter="stopAutoSlide()"
      @mouseleave="startAutoSlide()"
      class="relative flex min-h-screen flex-col items-center justify-center lg:flex-row overflow-hidden pt-24"
    >
      {{-- Slide Track (Backgrounds) --}}
      <div class="absolute inset-0 z-0 bg-background-dark overflow-hidden" :class="'dir-' + direction">
        @foreach ($banners as $index => $banner)
          <div
            x-show="slide === {{ $index }}"
            x-transition:enter="transition-transform duration-500 ease-in-out"
            x-transition:enter-start="bg-enter-start"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-500 ease-in-out"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="bg-leave-end"
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ Storage::url($banner->image) }}')"
          >
          </div>
        @endforeach
        {{-- Single overlay for all slides to prevent flickering during swap --}}
        <div class="hero-image-overlay z-10"></div>
      </div>

      {{-- Slide Content Wrapper (takes 50% width on desktop) --}}
      <div class="relative z-20 flex flex-col justify-center w-full lg:w-1/2 min-h-[60vh] lg:min-h-full">
        @foreach ($banners as $index => $banner)
          <div
            x-show="slide === {{ $index }}"
            x-transition:enter="transition ease-out duration-1000 delay-1000"
            x-transition:enter-start="opacity-0 translate-y-12"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="absolute inset-0 flex flex-col justify-center px-6 lg:px-24"
          >
            <div class="max-w-2xl">
              @if ($banner->badge_text)
                <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/60 px-3 py-1.5 rounded-sm">{{ $banner->badge_text }}</span>
              @endif
              <h1 class="mb-8 text-4xl font-extrabold uppercase tracking-tight leading-[1.05] text-white hero-glow-text text-shadow-dark md:text-5xl lg:text-6xl 2xl:text-7xl break-words">
                {{ $banner->title }}
                @if ($banner->highlight_text)
                  <span class="gold-gradient-text text-glow-light block mt-2 leading-[1.1] text-4xl md:text-5xl lg:text-6xl 2xl:text-7xl text-shadow-dark break-words">{{ $banner->highlight_text }}</span>
                @endif
              </h1>
              @if ($banner->description)
                <p class="mb-12 text-sm md:text-lg font-medium leading-relaxed text-white/90 drop-shadow-md bg-black/40 backdrop-blur-[4px] p-6 rounded-lg border-l-2 border-primary">
                  {{ $banner->description }}
                </p>
              @endif
              <div class="flex flex-row gap-5">
                @if ($banner->cta_primary_text)
                  <a href="{{ $banner->cta_primary_url ?? '#' }}" class="flex h-10 md:h-14 items-center justify-center rounded-lg gold-solid-gradient-orange gradient-border-opposite bevel-effect px-4 text-xs md:px-10 md:text-sm font-extrabold uppercase tracking-wider text-background-dark shadow-2xl cta-start-project">
                    {{ $banner->cta_primary_text }}
                  </a>
                @endif
                @if ($banner->cta_secondary_text)
                  <a href="{{ $banner->cta_secondary_url ?? '#' }}" class="flex h-10 md:h-14 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-4 text-xs md:px-10 md:text-sm font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright">
                    {{ $banner->cta_secondary_text }}
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Empty right column for layout consistency --}}
      <div class="hidden lg:block lg:w-1/2"></div>

      {{-- Navigation Controls --}}
      <div class="absolute right-10 bottom-8 z-20 flex items-center gap-4">
        {{-- Dots --}}
        <div class="flex items-center gap-2 mr-4">
          @foreach ($banners as $index => $banner)
            <button
              @click="goTo({{ $index }}); stopAutoSlide(); startAutoSlide();"
              :class="slide === {{ $index }} ? 'bg-primary shadow-[0_0_8px_#FFD700] scale-125' : 'bg-white/20 hover:bg-white/40'"
              class="size-2.5 rounded-full cursor-pointer transition-all duration-300"
              aria-label="Go to slide {{ $index + 1 }}"
            ></button>
          @endforeach
        </div>
        {{-- Arrows --}}
        <button @click="prev(); stopAutoSlide(); startAutoSlide();" class="flex h-10 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow ps-3 pe-1 text-xs font-bold uppercase tracking-wider text-primary transition-all rounded-lg btn-hover-glow" aria-label="Previous">
          <span class="material-symbols-outlined gold-gradient-icon text-xl leading-none align-middle">arrow_back_ios</span>
        </button>
        <button @click="next(); stopAutoSlide(); startAutoSlide();" class="flex h-10 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow pe-2 ps-2 text-xs font-bold uppercase tracking-wider text-primary transition-all rounded-lg btn-hover-glow" aria-label="Next">
          <span class="material-symbols-outlined gold-gradient-icon text-xl leading-none align-middle">arrow_forward_ios</span>
        </button>
      </div>
    </section>
  @endif

  <x-section-separator />

  {{-- Stats Section --}}
  @if ($stats->isNotEmpty())
    <section class="relative z-10 w-full border-y border-white/5">
      <div class="mx-auto max-w-[1440px] px-6 lg:px-20">
        <div class="grid grid-cols-2 gap-8 py-16 lg:grid-cols-4 lg:gap-0">
          @foreach ($stats as $index => $stat)
            <div class="flex items-center justify-center gap-4 {{ !$loop->last ? 'lg:border-r lg:border-white/5' : '' }}">
              <span class="material-symbols-outlined text-4xl gold-gradient-icon">{{ $stat->icon }}</span>
              <div class="flex flex-col text-left">
                <span class="text-2xl font-black text-white leading-none">{{ $stat->value }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-primary">{{ $stat->label }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- Services Section --}}
  <section class="relative px-6 py-24 lg:px-20 overflow-hidden" id="services">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-20 flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-end">
        <div class="max-w-2xl relative">
          <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-7xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('OUR SERVICES') }}</h2>
        </div>
        <div class="relative">
          <p class="max-w-md font-light text-white/60 text-sm pl-8 border-l border-primary">
            {{ __('Specialized solutions in Civil works, Mechanical-Electrical (ME), HVAC systems, and high-end Procurement for luxury commercial environments.') }}
          </p>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
          <a href="{{ route('service.detail', $service->slug) }}" class="group relative overflow-hidden rounded-xl bg-transparent p-10 transition-all thin-gold-border hover:bg-white/[0.04]">
            <div class="mb-8 flex items-center justify-between">
              <span class="material-symbols-outlined text-4xl gold-gradient-icon">{{ $service->icon }}</span>
              <span class="material-symbols-outlined text-white/20 group-hover:text-primary transition-colors opacity-0 group-hover:opacity-100 transform translate-x-[-10px] group-hover:translate-x-0 transition-all duration-300">arrow_forward</span>
            </div>
            <h3 class="mb-4 text-xl font-bold text-white group-hover:text-primary transition-colors">{{ $service->title }}</h3>
            <p class="text-sm font-light leading-relaxed text-white/50">{{ $service->short_description }}</p>
          </a>
        @endforeach
      </div>
      <div class="mt-16 flex justify-center">
        <a href="{{ route('services') }}" class="flex h-10 md:h-14 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-4 text-xs md:px-10 md:text-sm font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright">
          {{ __('View All Services') }}
        </a>
      </div>
    </div>
  </section>

  {{-- Projects Section --}}
  <section class="relative px-6 py-20 lg:px-20" id="projects">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-20 flex flex-col items-center text-center">
        <h2 class="text-4xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('FEATURED PROJECTS') }}</h2>
        <p class="mt-6 text-xs font-bold uppercase tracking-[0.5em] text-white/40">{{ __('PORTFOLIO OF EXCELLENCE') }}</p>
      </div>
      <div class="grid grid-cols-1 gap-x-12 gap-y-16 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($projects as $project)
          <div class="group flex flex-col items-start w-full">
            <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg thin-gold-border mb-6">
              @if ($project->image)
                <img alt="{{ $project->title }}" class="h-full w-full object-cover project-filter" src="{{ Storage::url($project->image) }}" />
              @else
                <div class="h-full w-full bg-white/5 flex items-center justify-center">
                  <span class="material-symbols-outlined text-6xl text-white/20">construction</span>
                </div>
              @endif
            </div>
            <div class="flex flex-col items-start w-full">
              <div class="flex items-center justify-between w-full mb-3">
                <h4 class="text-primary text-2xl font-extrabold uppercase tracking-wider">{{ $project->title }}</h4>
                <span class="px-3 py-1 bg-primary text-background-dark rounded-sm text-[10px] font-black tracking-widest">{{ $project->year }}</span>
              </div>
              <p class="text-white text-sm font-medium mb-1.5">{{ $project->location }}</p>
              <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em]">{{ $project->scope }}</p>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-24 flex justify-center">
        <a href="{{ route('projects') }}" class="flex h-10 md:h-14 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-4 text-xs md:px-10 md:text-sm font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright">
          {{ __('Browse All Projects') }}
        </a>
      </div>
    </div>
  </section>

  {{-- Clients Section --}}
  @php
    $clientsJson = $clients
        ->map(
            fn($c) => [
                'name' => $c->name,
                'logo' => $c->logo ? Storage::url($c->logo) : null,
            ],
        )
        ->toJson();
  @endphp
  <section class="relative px-6 py-24 lg:px-20" id="clients">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-6xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('OUR CLIENTS') }}</h2>
        <p class="mt-4 text-[10px] font-bold uppercase tracking-[0.5em] text-white/40">{{ __('PARTNERING WITH INDUSTRY LEADERS') }}</p>
      </div>

      <div x-data="{
          allClients: {{ $clientsJson }},
          slide: 0,
          perPage: 6,
          timer: null,
          get chunks() {
              const pages = [];
              for (let i = 0; i < this.allClients.length; i += this.perPage) {
                  pages.push(this.allClients.slice(i, i + this.perPage));
              }
              return pages;
          },
          get total() { return this.chunks.length; },
          updatePerPage() {
              const w = window.innerWidth;
              const next = w >= 1024 ? 6 : w >= 768 ? 4 : 2;
              if (next !== this.perPage) {
                  this.perPage = next;
                  this.slide = 0;
              }
          },
          startAutoSlide() {
              this.timer = setInterval(() => {
                  this.slide = this.slide < this.total - 1 ? this.slide + 1 : 0;
              }, 3000);
          },
          stopAutoSlide() {
              clearInterval(this.timer);
          },
          init() {
              this.updatePerPage();
              window.addEventListener('resize', () => this.updatePerPage());
              this.startAutoSlide();
          }
      }" @mouseenter="stopAutoSlide()" @mouseleave="startAutoSlide()">
        {{-- Slider track --}}
        <div class="overflow-hidden">
          <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${slide * 100}%)`">
            <template x-for="(chunk, idx) in chunks" :key="idx">
              <div class="w-full shrink-0 flex items-center justify-center gap-12 md:gap-16 lg:gap-24 py-10 px-8">
                <template x-for="client in chunk" :key="client.name">
                  <div class="group flex items-center justify-center w-28 h-28 shrink-0 cursor-pointer">
                    <template x-if="client.logo">
                      <img :alt="client.name" class="w-full h-full object-contain project-filter" :src="client.logo" />
                    </template>
                    <template x-if="!client.logo">
                      <span class="text-sm font-black tracking-tighter text-white uppercase text-center project-filter" x-text="client.name"></span>
                    </template>
                  </div>
                </template>
              </div>
            </template>
          </div>
        </div>

        {{-- Controls --}}
        <div class="mt-8 flex items-center justify-center gap-3">
          <template x-for="(chunk, idx) in chunks" :key="idx">
            <button @click="slide = idx; stopAutoSlide(); startAutoSlide();" :class="slide === idx ? 'bg-primary shadow-[0_0_8px_#FFD700] scale-125' : 'bg-white/20 hover:bg-white/40'" class="size-2 rounded-full cursor-pointer transition-all duration-300">
            </button>
          </template>
        </div>
      </div>
    </div>
  </section>


</div>
