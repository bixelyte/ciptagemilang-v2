<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden min-h-[50vh] flex items-center bg-fixed bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('storage/backgrounds/bg_contact.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-[2px]"></div>
    
    <div class="relative z-10 mx-auto w-full max-w-[1440px]">
      <div class="flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/80 px-4 py-2 rounded-sm border border-primary/20 backdrop-blur-md">
          {{ __('Get in Touch') }}
        </span>
        <h1 class="mt-2 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">
          {{ __('CONTACT US') }}
        </h1>
        <p class="mt-6 max-w-2xl text-white/80 text-base md:text-lg font-light leading-relaxed">
          {{ __('Have a project in mind? We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.') }}
        </p>

        <!-- Breadcrumbs -->
        <nav class="mt-10 flex items-center justify-center space-x-2 text-sm font-medium text-white/50 backdrop-blur-md bg-background-dark/50 px-6 py-3 rounded-full border border-white/10">
          <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">home</span>
            {{ __('Home') }}
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <span class="text-white">{{ __('Contact') }}</span>
        </nav>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Contact Form & Info --}}
  <section class="relative px-6 py-24 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        {{-- Contact Info --}}
        <div class="lg:col-span-1">
          <h3 class="text-2xl font-bold text-white mb-8">{{ __('Contact Information') }}</h3>
          <div class="flex flex-col gap-8">
            <div class="flex items-start gap-4">
              <div class="flex size-12 shrink-0 items-center justify-center rounded-lg thin-gold-border bg-white/[0.02]">
                <span class="material-symbols-outlined text-xl gold-gradient-icon">location_on</span>
              </div>
              <div>
                <h4 class="text-sm font-bold text-white mb-1">{{ __('Address') }}</h4>
                <p class="text-sm text-white/50">{!! nl2br(e($companyAddress)) !!}</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="flex size-12 shrink-0 items-center justify-center rounded-lg thin-gold-border bg-white/[0.02]">
                <span class="material-symbols-outlined text-xl gold-gradient-icon">call</span>
              </div>
              <div>
                <h4 class="text-sm font-bold text-white mb-1">{{ __('Phone Number') }}</h4>
                <p class="text-sm text-white/50">{{ $companyPhone }}</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="flex size-12 shrink-0 items-center justify-center rounded-lg thin-gold-border bg-white/[0.02]">
                <span class="material-symbols-outlined text-xl gold-gradient-icon">mail</span>
              </div>
              <div>
                <h4 class="text-sm font-bold text-white mb-1">{{ __('Email Address') }}</h4>
                <p class="text-sm text-white/50">{{ $companyEmail }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
          @if ($submitted)
            <div class="rounded-xl thin-gold-border bg-white/[0.02] p-12 text-center">
              <span class="material-symbols-outlined text-6xl gold-gradient-icon mb-4">check_circle</span>
              <h3 class="text-2xl font-bold text-white mb-4">{{ __('Message Sent!') }}</h3>
              <p class="text-white/50 mb-8">{{ __('Thank you for your message! We will get back to you shortly.') }}</p>
              <button wire:click="$set('submitted', false)" class="inline-flex h-10 md:h-12 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-8 text-xs md:text-sm font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright">
                {{ __('Send Another Message') }}
              </button>
            </div>
          @else
            <form wire:submit="submit" class="rounded-xl thin-gold-border bg-white/[0.02] p-10">
              <h3 class="text-2xl font-bold text-white mb-8">{{ __('Send a Message') }}</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Your Name') }} *</label>
                  <input wire:model="name" type="text" class="w-full h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" placeholder="{{ __('Your Name') }}" />
                  @error('name')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Email Address') }} *</label>
                  <input wire:model="email" type="email" class="w-full h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" placeholder="{{ __('Email Address') }}" />
                  @error('email')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Phone Number') }}</label>
                  <input wire:model="phone" type="text" class="w-full h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" placeholder="{{ __('Phone Number') }}" />
                  @error('phone')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Company') }}</label>
                  <input wire:model="company" type="text" class="w-full h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" placeholder="{{ __('Company') }}" />
                  @error('company')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Subject') }} *</label>
                  <input wire:model="subject" type="text" class="w-full h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" placeholder="{{ __('Subject') }}" />
                  @error('subject')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-white/60 mb-2">{{ __('Your Message') }} *</label>
                  <textarea wire:model="message" rows="5" class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-3 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30 resize-none" placeholder="{{ __('Your Message') }}"></textarea>
                  @error('message')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="mt-8">
                <button type="submit" class="flex h-10 md:h-14 items-center justify-center rounded-lg gold-solid-gradient-orange gradient-border-opposite bevel-effect px-4 text-xs md:px-10 md:text-sm font-extrabold uppercase tracking-wider text-background-dark shadow-2xl cta-start-project" wire:loading.attr="disabled">
                  <span wire:loading.remove>{{ __('Send Message') }}</span>
                  <span wire:loading>{{ __('Sending...') }}</span>
                </button>
              </div>
            </form>
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
