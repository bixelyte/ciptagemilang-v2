<div x-data="{
    modal: {
        isOpen: false,
        id: null,
        type: null,
        title: '',
        icon: '',
        short_description: '',
        description: '',
        image: '',
        image_class: 'object-cover',
        image_aspect: 'aspect-[4/3] lg:aspect-square',
        video: '',
        meta1: '',
        badge: ''
    },
    openModal(data) {
        this.modal = { ...this.modal, ...data, isOpen: true };
        document.body.style.overflow = 'hidden';
        window.history.pushState({ modal: data.id, type: data.type }, '', '#' + data.type + '-' + data.id);
    },
    closeModal() {
        this.modal.isOpen = false;
        document.body.style.overflow = '';
        if (window.location.hash.includes('#' + this.modal.type + '-')) {
           window.history.back();
        }
    }
}"
@keydown.escape.window="if(modal.isOpen) closeModal()"
@popstate.window="if (modal.isOpen && !window.location.hash.includes('#' + modal.type + '-')) { modal.isOpen = false; document.body.style.overflow = ''; }"
>
  <style>
    .dir-next .bg-enter-start { transform: translateX(100%); }
    .dir-next .bg-leave-end { transform: translateX(-100%); }
    .dir-prev .bg-enter-start { transform: translateX(-100%); }
    .dir-prev .bg-leave-end { transform: translateX(100%); }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(255, 215, 0, 0.4); }
    * { scrollbar-width: thin; scrollbar-color: rgba(255, 255, 255, 0.1) transparent; }
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
              <div class="flex flex-row gap-5 hidden">
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

  {{-- About Us Section --}}
  <section class="relative px-6 py-24 lg:px-20 scroll-mt-28" id="about">
    <div class="mx-auto max-w-[1440px]">
      <div class="flex flex-col lg:flex-row items-start gap-16 lg:gap-24">
        {{-- Left side: Image --}}
        <div class="w-full lg:w-5/12">
            <div class="relative w-full aspect-[3/4] lg:aspect-[4/5] rounded-xl overflow-hidden border-2 border-primary shadow-[0_0_20px_rgba(255,165,0,0.3)]">
                <img src="{{ asset('images/about_us_building.png') }}" alt="Luxurious Construction and Office Building" class="w-full h-full object-cover" />
            </div>
        </div>

        {{-- Right side: Content --}}
        <div class="w-full lg:w-7/12 flex flex-col items-start px-2 lg:px-0">
            <div class="max-w-2xl relative mb-10">
                <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-7xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('ABOUT US') }}</h2>
            </div>

            <p class="text-white/60 text-sm md:text-base font-light leading-relaxed mb-6 max-w-2xl whitespace-pre-line">
                {{ \App\Models\CompanySetting::get('about_description') }}
            </p>

            <p class="text-white/60 text-sm md:text-base font-light leading-relaxed mb-6 max-w-2xl whitespace-pre-line">
                <strong class="text-white font-bold">{{ __('Our Mission') }}:</strong> {{ \App\Models\CompanySetting::get('about_mission') }}
            </p>

            <p class="text-white/60 text-sm md:text-base font-light leading-relaxed mb-10 max-w-2xl whitespace-pre-line">
                <strong class="text-white font-bold">{{ __('Our Vision') }}:</strong> {{ \App\Models\CompanySetting::get('about_vision') }}
            </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Services Section --}}
  <section class="relative px-6 py-24 lg:px-20 overflow-hidden scroll-mt-28" id="services">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-20 flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-end">
        <div class="max-w-2xl relative">
          <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-7xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('SERVICES') }}</h2>
        </div>
        <div class="relative">
          <p class="max-w-md font-light text-white/60 text-sm pl-8 border-l border-primary">
            {{ __('Specialized solutions in Civil works, Mechanical-Electrical (ME), HVAC systems, and high-end Procurement for luxury commercial environments.') }}
          </p>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
          @php
             $img = $service->attachments()->where('type', 'image')->first();
             $imgUrl = $img ? Storage::url($img->file_path) : '';
          @endphp
          <button type="button" @click="openModal({
              id: {{ $service->id }},
              type: 'service',
              title: @js($service->title),
              icon: @js($service->icon),
              short_description: @js($service->short_description),
              description: @js($service->description),
              image: @js($imgUrl),
              image_aspect: 'aspect-[4/3] lg:aspect-square',
              image_class: 'object-cover project-filter'
          })" class="w-full text-left group relative overflow-hidden rounded-xl bg-transparent p-10 transition-all thin-gold-border hover:bg-white/[0.04]">
            <div class="mb-8 flex items-center justify-between">
              <span class="material-symbols-outlined text-4xl gold-gradient-icon">{{ $service->icon }}</span>
              <span class="material-symbols-outlined text-white/20 group-hover:text-primary transition-colors opacity-0 group-hover:opacity-100 transform translate-x-[-10px] group-hover:translate-x-0 transition-all duration-300">open_in_new</span>
            </div>
            <h3 class="mb-4 text-xl font-bold text-white group-hover:text-primary transition-colors">{{ $service->title }}</h3>
            <p class="text-sm font-light leading-relaxed text-white/50">{{ $service->short_description }}</p>
          </button>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Projects Section --}}
  <section class="relative px-6 py-20 lg:px-20 scroll-mt-28" id="projects">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-10 flex flex-col items-center text-center">
        <h2 class="text-4xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('PROJECTS') }}</h2>
      </div>
      <div x-data="{ projectTab: 'featured' }" class="w-full">
         <div class="flex flex-wrap justify-center gap-8 border-b border-white/10 mb-12">
            <button @click="projectTab = 'featured'" :class="projectTab === 'featured' ? 'border-primary text-primary' : 'border-transparent text-white/50 hover:text-white/80'" class="pb-4 border-b-2 font-bold uppercase tracking-wider transition-colors">{{ __('Featured Projects') }}</button>
            <button @click="projectTab = 'all'" :class="projectTab === 'all' ? 'border-primary text-primary' : 'border-transparent text-white/50 hover:text-white/80'" class="pb-4 border-b-2 font-bold uppercase tracking-wider transition-colors">{{ __('All Projects') }}</button>
         </div>

         <div x-show="projectTab === 'featured'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
             <div class="grid grid-cols-1 gap-x-12 gap-y-16 md:grid-cols-2 lg:grid-cols-3">
               @foreach ($projects as $project)
                 <button type="button" @click="openModal({
                     id: {{ $project->id }},
                     type: 'project',
                     title: @js($project->client?->name ?? 'Project'),
                     icon: 'domain',
                     short_description: @js($project->location),
                     description: @js($project->description),
                     meta1: @js($project->type),
                     meta2: @js($project->scope),
                     badge: @js($project->year),
                     image: @js($project->image ? Storage::url($project->image) : ''),
                     video: @js($project->video ? Storage::url($project->video) : ''),
                     image_aspect: 'aspect-[4/3]',
                     image_class: 'object-cover project-filter group-hover:scale-105 transition-transform duration-700'
                 })" class="group flex flex-col items-start w-full text-left cursor-pointer hover:opacity-90 transition-opacity">
                   <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg thin-gold-border mb-6">
                     @if ($project->image)
                       <img alt="{{ $project->title }}" class="h-full w-full object-cover project-filter group-hover:scale-105 transition-transform duration-700" src="{{ Storage::url($project->image) }}" />
                     @else
                       <div class="h-full w-full bg-white/5 flex items-center justify-center">
                         <span class="material-symbols-outlined text-6xl text-white/20 group-hover:scale-110 transition-transform duration-700">construction</span>
                       </div>
                     @endif
                   </div>
                   <div class="flex flex-col items-start w-full">
                     <div class="flex items-center justify-between w-full mb-3">
                       <h4 class="text-primary text-2xl font-extrabold uppercase tracking-wider">{{ $project->client?->name ?? 'Project' }}</h4>
                       <span class="px-3 py-1 bg-primary text-background-dark rounded-sm text-[10px] font-black tracking-widest">{{ $project->year }}</span>
                     </div>
                     <p class="text-white text-sm font-medium mb-1.5">{{ $project->location }}</p>
                     <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] relative pr-6">
                       {{ $project->type }}
                       <span class="material-symbols-outlined text-xs absolute right-0 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all duration-300">open_in_new</span>
                     </p>
                   </div>
                 </button>
               @endforeach
             </div>
         </div>

         <div x-show="projectTab === 'all'" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
             {{-- Toolbar --}}
             <div class="flex flex-col md:flex-row gap-4 mb-6">
                 <input wire:model.live.debounce.300ms="searchProject" type="text" placeholder="{{ __('Search title or location...') }}" class="bg-black/50 border border-white/10 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors flex-1 w-full md:w-auto">
                 <select wire:model.live="filterYear" class="bg-black/50 border border-white/10 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors w-full md:w-auto">
                     <option value="" class="bg-background-dark">{{ __('All Years') }}</option>
                     @foreach($availableYears as $y)
                         <option value="{{ $y }}" class="bg-background-dark">{{ $y }}</option>
                     @endforeach
                 </select>
                 <select wire:model.live="filterType" class="bg-black/50 border border-white/10 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors w-full md:max-w-xs">
                     <option value="" class="bg-background-dark">{{ __('All Types') }}</option>
                     @foreach($availableTypes as $s)
                         <option value="{{ $s }}" class="bg-background-dark">{{ $s }}</option>
                     @endforeach
                 </select>
             </div>

             {{-- Table --}}
             <div class="overflow-x-auto rounded-lg border border-white/10 bg-white/5 shadow-2xl backdrop-blur-sm">
                 <table class="w-full text-left text-sm text-white/80">
                     <thead class="bg-white/5 font-bold uppercase tracking-wider text-xs border-b border-white/10 text-white/60">
                         <tr>
                             <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors whitespace-nowrap" wire:click="sortProjects('title')">
                                 <div class="flex items-center gap-2">{{ __('Title') }} <span class="text-primary text-[10px]">{{ $sortField === 'title' ? ($sortDirection === 'asc' ? '▲' : '▼') : '' }}</span></div>
                             </th>
                             <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors whitespace-nowrap" wire:click="sortProjects('location')">
                                 <div class="flex items-center gap-2">{{ __('Location') }} <span class="text-primary text-[10px]">{{ $sortField === 'location' ? ($sortDirection === 'asc' ? '▲' : '▼') : '' }}</span></div>
                             </th>
                             <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors whitespace-nowrap" wire:click="sortProjects('year')">
                                 <div class="flex items-center gap-2">{{ __('Year') }} <span class="text-primary text-[10px]">{{ $sortField === 'year' ? ($sortDirection === 'asc' ? '▲' : '▼') : '' }}</span></div>
                             </th>
                             <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors whitespace-nowrap" wire:click="sortProjects('type')">
                                 <div class="flex items-center gap-2">{{ __('Type') }} <span class="text-primary text-[10px]">{{ $sortField === 'type' ? ($sortDirection === 'asc' ? '▲' : '▼') : '' }}</span></div>
                             </th>
                             <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors whitespace-nowrap" wire:click="sortProjects('scope')">
                                 <div class="flex items-center gap-2">{{ __('Scope') }} <span class="text-primary text-[10px]">{{ $sortField === 'scope' ? ($sortDirection === 'asc' ? '▲' : '▼') : '' }}</span></div>
                             </th>
                         </tr>
                     </thead>
                     <tbody class="divide-y divide-white/5">
                         @forelse($allProjects as $ap)
                         <tr class="hover:bg-white/[0.04] transition-colors cursor-pointer group" @click="openModal({
                              id: {{ $ap->id }},
                              type: 'project',
                              title: @js($ap->client?->name ?? 'Project'),
                              icon: 'domain',
                              short_description: @js($ap->location),
                              description: @js($ap->description),
                              meta1: @js($ap->type),
                              meta2: @js($ap->scope),
                              badge: @js($ap->year),
                              image: @js($ap->image ? Storage::url($ap->image) : ''),
                              video: @js($ap->video ? Storage::url($ap->video) : ''),
                              image_aspect: 'aspect-[4/3]',
                              image_class: 'object-cover project-filter group-hover:scale-105 transition-transform duration-700'
                          })">
                             <td class="px-6 py-5 font-bold text-white group-hover:text-primary transition-colors flex items-center justify-between min-w-[200px]">
                                 {{ $ap->client?->name ?? 'Project' }}
                                 <span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-opacity text-primary ml-2">open_in_new</span>
                             </td>
                             <td class="px-6 py-5 min-w-[200px]">{{ $ap->location }}</td>
                             <td class="px-6 py-5"><span class="px-3 py-1 bg-primary text-background-dark rounded-sm text-[10px] font-black tracking-widest">{{ $ap->year }}</span></td>
                             <td class="px-6 py-5 text-white/50 text-xs tracking-wider uppercase min-w-[250px]">{{ $ap->type }}</td>
                             <td class="px-6 py-5 text-white/50 text-xs tracking-wider uppercase min-w-[250px]">{{ $ap->scope }}</td>
                         </tr>
                         @empty
                         <tr>
                             <td colspan="4" class="px-6 py-12 text-center text-white/40 font-light tracking-wider uppercase">{{ __('No projects found matching the criteria.') }}</td>
                         </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>
             
             @if($allProjects->hasPages())
             <div class="mt-8">
                 {{ $allProjects->links() }}
             </div>
             @endif
         </div>
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
                'website' => $c->website,
            ],
        )
        ->toJson();
  @endphp
  <section class="relative px-6 py-24 lg:px-20 scroll-mt-28" id="clients">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-6xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('CLIENTS') }}</h2>
        <p class="mt-4 text-[10px] font-bold uppercase tracking-[0.5em] text-white/40">{{ __('TRUSTED BY BRANDS') }}</p>
      </div>

      <div x-data="{
          allClients: {{ $clientsJson }},
          slide: 0,
          perPage: 8,
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
              // lg: 4 cols * 2 rows = 8
              // md: 3 cols * 3 rows = 9
              // sm: 2 cols * 3 rows = 6
              const next = w >= 1024 ? 8 : w >= 768 ? 9 : 6;
              if (next !== this.perPage) {
                  this.perPage = next;
                  if (this.slide >= this.chunks.length) this.slide = 0;
              }
          },
          startAutoSlide() {
              if (this.total <= 1) return;
              this.timer = setInterval(() => {
                  this.slide = this.slide < this.total - 1 ? this.slide + 1 : 0;
              }, 5000);
          },
          stopAutoSlide() {
              clearInterval(this.timer);
          },
          init() {
              this.updatePerPage();
              window.addEventListener('resize', () => { 
                this.updatePerPage(); 
                if (this.total <= 1) this.stopAutoSlide(); 
              });
              this.startAutoSlide();
          }
      }" @mouseenter="stopAutoSlide()" @mouseleave="startAutoSlide()" class="relative">
        
        {{-- Slider Track Container --}}
        <div class="overflow-hidden">
          <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${slide * 100}%)`">
            <template x-for="(chunk, idx) in chunks" :key="idx">
              <div class="w-full shrink-0">
                <div class="flex flex-wrap items-center justify-center gap-y-8 lg:gap-y-12">
                  <template x-for="client in chunk" :key="client.name">
                    <div class="flex items-center justify-center w-1/2 md:w-1/3 lg:w-1/4 px-4">
                      <a :href="client.website" target="_blank">
                        <div class="flex items-center justify-center w-full max-w-[200px] aspect-[4/3] text-center">
                          <template x-if="client.logo">
                            <img :alt="client.name" class="w-full h-full object-contain" :src="client.logo" />
                          </template>
                          <template x-if="!client.logo">
                            <span class="text-sm font-black tracking-tighter text-white uppercase" x-text="client.name"></span>
                          </template>
                        </div>
                      </a>
                    </div>
                  </template>
                </div>
              </div>
            </template>
          </div>
        </div>

        {{-- Dots Navigation --}}
        <div class="mt-12 flex justify-center gap-3" x-show="total > 1" x-cloak>
          <template x-for="(chunk, idx) in chunks" :key="idx">
            <button @click="slide = idx; stopAutoSlide(); startAutoSlide();" 
                    :class="slide === idx ? 'bg-primary shadow-[0_0_8px_#FFD700] scale-125' : 'bg-white/20 hover:bg-white/40'" 
                    class="size-2 rounded-full cursor-pointer transition-all duration-300">
            </button>
          </template>
        </div>

      </div>
    </div>
  </section>

  {{-- Contact Section --}}
  <section class="relative px-6 py-24 lg:px-20 overflow-hidden scroll-mt-28" id="contact">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-black uppercase tracking-tighter lg:text-6xl gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('CONTACT') }}</h2>
        <p class="mt-4 text-[10px] font-bold uppercase tracking-[0.5em] text-white/40">{{ __('GET IN TOUCH WITH OUR TEAM') }}</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">
        {{-- Left side: Contact Form & Info --}}
        <div class="flex flex-col w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                    <div>
                        <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-2">{{ __('Office Address') }}</h4>
                        <p class="text-white/60 text-sm leading-relaxed">{!! nl2br(e($companyAddress)) !!}</p>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">call</span>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-2">{{ __('Phone') }}</h4>
                            <p class="text-white/60 text-sm leading-relaxed">{{ $companyPhone }}</p>
                        </div>
                    </div>
                    @if($companyFax)
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">fax</span>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-2">{{ __('Fax') }}</h4>
                            <p class="text-white/60 text-sm leading-relaxed">{{ $companyFax }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">mail</span>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-2">{{ __('Email') }}</h4>
                            <p class="text-white/60 text-sm leading-relaxed">{{ $companyEmail }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-xl p-8 pb-10 shadow-2xl backdrop-blur-sm relative border-t-4 border-t-primary">
                <form wire:submit.prevent="submitContact" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-white/50 mb-2">{{ __('Your Name') }}</label>
                            <input wire:model="contactName" type="text" class="w-full bg-black/50 border border-white/10 rounded-md px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors" placeholder="">
                            @error('contactName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-white/50 mb-2">{{ __('Email Address') }}</label>
                            <input wire:model="contactEmail" type="email" class="w-full bg-black/50 border border-white/10 rounded-md px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors" placeholder="">
                            @error('contactEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-white/50 mb-2">{{ __('Subject') }}</label>
                        <input wire:model="contactSubject" type="text" class="w-full bg-black/50 border border-white/10 rounded-md px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors" placeholder="">
                        @error('contactSubject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-white/50 mb-2">{{ __('Message') }}</label>
                        <textarea wire:model="contactMessage" rows="4" class="w-full bg-black/50 border border-white/10 rounded-md px-4 py-3 text-white text-sm focus:outline-none focus:border-primary transition-colors resize-none" placeholder=""></textarea>
                        @error('contactMessage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    @if($contactSubmitted)
                        <div class="p-4 bg-green-500/20 border border-green-500/50 rounded-md text-green-400 text-sm font-bold text-center">
                            {{ __('Thank you for your message! We will get back to you shortly.') }}
                        </div>
                    @else
                        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-sm bg-primary hover:brightness-110 px-8 text-sm font-black text-background-dark uppercase tracking-wide transition-all shadow-[0_0_15px_rgba(255,165,0,0.2)]">
                            <span wire:loading.remove wire:target="submitContact">{{ __('Send Message') }}</span>
                            <span wire:loading wire:target="submitContact">{{ __('Sending...') }}</span>
                        </button>
                    @endif
                </form>
            </div>
        </div>

        {{-- Right side: Map --}}
        <div class="w-full h-[500px] lg:h-full min-h-[500px] rounded-xl overflow-hidden border-2 border-primary/20 shadow-[0_0_20px_rgba(255,165,0,0.1)] transition-all duration-700">
            <iframe 
                src="https://maps.google.com/maps?q={{ urlencode(strip_tags($companyAddress)) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
      </div>
    </div>
  </section>

  {{-- Global Modal --}}
  <template x-teleport="body">
    <div x-cloak x-show="modal.isOpen" class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6 lg:p-10">
      
      {{-- Backdrop --}}
      <div x-transition.opacity @click="closeModal()" class="absolute inset-0 bg-black/50 backdrop-blur-sm cursor-pointer"></div>
      
      {{-- Modal Window --}}
      <div x-transition.scale.95 
           class="relative w-full max-w-5xl h-[90vh] lg:h-[85vh] bg-background-dark border border-white/10 shadow-2xl rounded-2xl flex flex-col z-10 overflow-hidden">
        
        {{-- Fixed Header --}}
         <div class="flex-none border-b border-white/5 bg-background-dark/95 backdrop-blur-md px-6 py-5 lg:px-10 flex justify-between items-center z-20 shadow-md">
            <div class="flex flex-col pr-4">
                <h2 class="text-2xl lg:text-4xl font-black uppercase tracking-tighter gold-gradient-text leading-none break-words line-clamp-2" x-text="modal.title"></h2>
                {{-- Subtitle for Project --}}
                <template x-if="modal.type === 'project' && modal.short_description">
                    <p class="text-white/60 text-sm mt-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                        <span x-text="modal.short_description"></span>
                    </p>
                </template>
            </div>
           <button @click="closeModal()" class="flex-shrink-0 flex size-10 items-center justify-center rounded-full bg-white/5 text-white/50 hover:bg-white/20 hover:text-white transition-colors shadow-none cursor-pointer">
             <span class="material-symbols-outlined text-2xl">close</span>
           </button>
        </div>

        {{-- Scrollable Body --}}
        <div class="flex-1 overflow-y-auto overscroll-contain px-6 py-8 lg:px-10 lg:py-12">
            
           {{-- Service Modal Layout --}}
           <template x-if="modal.type !== 'project'">
             <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
               {{-- Left: Text --}}
               <div class="w-full lg:w-1/2 flex flex-col order-1">
                 <template x-if="modal.meta1 || modal.short_description">
                     <div class="mb-8 border-l-2 border-primary pl-5">
                       <template x-if="modal.meta1">
                           <p class="text-primary text-xs lg:text-sm font-bold uppercase tracking-[0.2em] mb-3" x-text="modal.meta1"></p>
                       </template>
                       <template x-if="modal.short_description">
                           <p class="text-white/80 font-bold text-base lg:text-lg leading-relaxed" x-text="modal.short_description"></p>
                       </template>
                     </div>
                 </template>
                 
                 <template x-if="modal.description">
                     <div class="text-white/60 font-light leading-loose text-sm lg:text-base prose prose-invert prose-p:mb-6 prose-ul:mb-6 prose-ul:pl-5 prose-li:mb-2 max-w-none" x-html="modal.description">
                     </div>
                 </template>
               </div>

               {{-- Right: Image --}}
               <div class="w-full lg:w-1/2 order-2">
                 <div class="relative w-full rounded-xl overflow-hidden thin-gold-border shadow-2xl bg-white/5" :class="modal.image_aspect">
                   <template x-if="modal.image">
                     <img :src="modal.image" :alt="modal.title" class="w-full h-full" :class="modal.image_class">
                   </template>
                   <template x-if="!modal.image">
                     <div class="absolute inset-0 flex items-center justify-center"><span class="material-symbols-outlined text-6xl text-white/20">image</span></div>
                   </template>
                 </div>
               </div>
             </div>
           </template>

           {{-- Project Modal Layout --}}
           <template x-if="modal.type === 'project'">
              <div class="flex flex-col gap-10">
                  {{-- Full width image and video --}}
                  <div class="flex flex-col gap-6">
                      <template x-if="modal.image && !modal.video">
                          <div class="w-full rounded-2xl overflow-hidden shadow-2xl relative bg-white/5">
                              <img :src="modal.image" :alt="modal.title" class="w-full h-auto object-cover max-h-[70vh]">
                          </div>
                      </template>
                      <template x-if="modal.video">
                          <div class="w-full rounded-2xl overflow-hidden shadow-2xl relative bg-black border border-white/10 aspect-video">
                              <video controls class="w-full h-full object-contain">
                                  <source :src="modal.video" type="video/mp4">
                                  Your browser does not support the video tag.
                              </video>
                          </div>
                      </template>
                  </div>
                  
                  {{-- Project Meta & Description --}}
                  <div class="flex flex-col gap-8">
                      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                          <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                              <h4 class="text-white/40 text-xs font-bold uppercase tracking-widest mb-1">{{ __('Year') }}</h4>
                              <p class="text-primary font-bold text-lg" x-text="modal.badge"></p>
                          </div>
                          <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                              <h4 class="text-white/40 text-xs font-bold uppercase tracking-widest mb-1">{{ __('Type') }}</h4>
                              <p class="text-primary font-bold text-base whitespace-pre-line" x-text="modal.meta1"></p>
                          </div>
                          <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                              <h4 class="text-white/40 text-xs font-bold uppercase tracking-widest mb-1">{{ __('Scope') }}</h4>
                              <p class="text-primary font-bold text-base whitespace-pre-line" x-text="modal.meta2"></p>
                          </div>
                      </div>
                      <template x-if="modal.description">
                          <div class="w-full">
                              <h3 class="text-xl font-bold text-white mb-4 uppercase tracking-wider">{{ __('Project Description') }}</h3>
                              <div class="text-white/70 font-light leading-relaxed text-base prose prose-invert max-w-none break-words" x-html="modal.description"></div>
                          </div>
                      </template>
                  </div>
              </div>
           </template>

         </div>
      </div>
    </div>
  </template>

</div>
