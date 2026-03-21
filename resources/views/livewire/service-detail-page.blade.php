<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden min-h-[50vh] flex items-center bg-fixed bg-center bg-cover bg-no-repeat" style="background-image: url('{{ $service->image ? Storage::url($service->image) : asset('storage/backgrounds/bg_services.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-[2px]"></div>
    
    <div class="relative z-10 mx-auto w-full max-w-[1440px]">
      <div class="flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/80 px-4 py-2 rounded-sm border border-primary/20 backdrop-blur-md">
          {{ __('Service Details') }}
        </span>
        <h1 class="mt-2 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">
          {{ $service->title }}
        </h1>
        <p class="mt-6 max-w-2xl text-white/80 text-base md:text-lg font-light leading-relaxed">
          {{ $service->short_description }}
        </p>

        <!-- Breadcrumbs -->
        <nav class="mt-10 flex items-center justify-center space-x-2 text-sm font-medium text-white/50 backdrop-blur-md bg-background-dark/50 px-6 py-3 rounded-full border border-white/10">
          <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">home</span>
            {{ __('Home') }}
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <a href="{{ route('services') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            {{ __('Services') }}
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <span class="text-white">{{ $service->title }}</span>
        </nav>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Content --}}
  <section class="relative px-6 py-24 lg:px-20 overflow-hidden">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        {{-- Left: Main Content --}}
        <div class="lg:col-span-8">
          <div class="mb-10 flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex size-24 shrink-0 items-center justify-center rounded-2xl thin-gold-border bg-background-dark shadow-[0_0_30px_rgba(255,215,0,0.1)]">
              <span class="material-symbols-outlined text-5xl gold-gradient-icon">{{ $service->icon }}</span>
            </div>
            <div>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tight">{{ $service->title }}</h2>
              <div class="mt-2 h-1 w-20 bg-gradient-to-r from-primary to-transparent"></div>
            </div>
          </div>
          
          <div class="mb-12">
            <p class="text-xl md:text-2xl font-light leading-relaxed text-white/90 border-l-4 border-primary pl-6">
              {{ $service->short_description }}
            </p>
          </div>

          <div class="prose prose-invert prose-lg max-w-none prose-headings:text-white prose-headings:font-bold prose-headings:tracking-tight prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-strong:text-white prose-strong:font-bold prose-ul:text-white/70 prose-li:marker:text-primary text-white/70 leading-loose font-light break-words">
            {!! $service->description !!}
          </div>
        </div>

        {{-- Right: Sidebar Image & Widget --}}
        <div class="lg:col-span-4 space-y-10">
          {{-- Service Image --}}
          <div class="relative aspect-[4/5] w-full overflow-hidden rounded-2xl thin-gold-border shadow-2xl group">
            <img 
              src="{{ $service->image ? Storage::url($service->image) : asset('storage/backgrounds/bg_services.png') }}" 
              alt="{{ $service->title }}"
              class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80"></div>
          </div>
          
          {{-- Quick Contact Widget --}}
          <div class="rounded-2xl bg-white/[0.02] thin-gold-border p-8 backdrop-blur-sm relative overflow-hidden">
             <div class="absolute top-0 right-0 p-4 opacity-5">
               <span class="material-symbols-outlined text-9xl">support_agent</span>
             </div>
             <h4 class="text-xl font-bold text-white mb-4">{{ __('Need Consultation?') }}</h4>
             <p class="text-white/50 text-sm mb-6">{{ __('Speak with our experts to find the best solution for your requirements.') }}</p>
             <a href="{{ route('contact') }}" class="flex h-12 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-4 text-xs font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright w-full">
               {{ __('Contact Us') }}
             </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Attachments Section --}}
  @if($service->attachments->isNotEmpty())
  <section class="relative px-6 py-16 lg:px-20 bg-background-dark/30">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-10 flex flex-col items-start">
        <h3 class="text-2xl lg:text-3xl font-black uppercase tracking-tighter text-white">{{ __('Media & Attachments') }}</h3>
        <div class="mt-4 h-1 w-16 bg-gradient-to-r from-primary to-transparent"></div>
      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($service->attachments as $attachment)
          <div class="group relative aspect-[4/3] overflow-hidden rounded-2xl bg-white/5 thin-gold-border transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,215,0,0.15)] flex flex-col">
            <div class="relative flex-1 overflow-hidden">
                @if($attachment->type === 'video')
                  <video src="{{ Storage::url($attachment->file_path) }}" controls class="h-full w-full object-cover"></video>
                @else
                  <img src="{{ Storage::url($attachment->file_path) }}" alt="{{ $attachment->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            </div>
            @if($attachment->title || $attachment->description)
            <div class="bg-background-dark p-5 border-t border-white/5 relative z-10 transition-colors duration-300 group-hover:bg-white/[0.02]">
              @if($attachment->title)
              <h4 class="text-base font-bold text-white group-hover:text-primary transition-colors tracking-wide">{{ $attachment->title }}</h4>
              @endif
              @if($attachment->description)
              <p class="mt-2 text-sm text-white/50 line-clamp-2 leading-relaxed font-light">{{ $attachment->description }}</p>
              @endif
            </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <x-section-separator />
  @endif

  {{-- Other Services Section --}}
  @if($otherServices->isNotEmpty())
  <section class="relative px-6 py-24 lg:px-20 bg-background-dark/50">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-16 flex flex-col items-center text-center">
        <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">{{ __('Explore Other Services') }}</h2>
        <div class="mt-6 h-1 w-24 bg-gradient-to-r from-transparent via-primary to-transparent"></div>
      </div>
      
      <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
        @foreach ($otherServices as $otherService)
          <a href="{{ route('service.detail', $otherService->slug) }}" class="group relative overflow-hidden rounded-xl bg-background-dark p-10 transition-all thin-gold-border hover:bg-white/[0.04] shadow-xl">
            <div class="mb-8 flex items-center justify-between">
              <span class="material-symbols-outlined text-4xl gold-gradient-icon group-hover:scale-110 transition-transform duration-300">{{ $otherService->icon }}</span>
              <span class="material-symbols-outlined text-white/20 group-hover:text-primary transition-all opacity-0 group-hover:opacity-100 transform translate-x-[-10px] group-hover:translate-x-0 duration-300">arrow_forward</span>
            </div>
            <h3 class="mb-4 text-xl font-bold text-white group-hover:text-primary transition-colors">{{ $otherService->title }}</h3>
            <p class="text-sm font-light leading-relaxed text-white/50 line-clamp-3">{{ $otherService->short_description }}</p>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  <x-section-separator />
  @endif
</div>
