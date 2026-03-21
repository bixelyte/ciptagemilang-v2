@php
  $companyShortName = \App\Models\CompanySetting::get('company_short_name', 'CIPTA GEMILANG');
  $companyTagline = \App\Models\CompanySetting::get('company_tagline', 'TEKNIK MANDIRI');
  $currentLocale = app()->getLocale();
@endphp

<header class="fixed top-0 z-50 w-full border-b border-white/5 bg-background-dark/80 backdrop-blur-md">
  <div class="mx-auto flex max-w-[1440px] items-center justify-between px-6 py-6 lg:px-20">
    <a href="/" class="flex items-center gap-4">
      <div class="flex items-center">
        <img alt="CIPTA GEMILANG logo" class="h-full w-full p-1" src="{{ asset('images/logo.svg') }}" />
      </div>
      <h2 class="text-xl font-extrabold uppercase tracking-widest text-white leading-tight">
        {{ $companyShortName }} <br />
        <span class="text-corporate-orange">{{ $companyTagline }}</span>
      </h2>
    </a>
    <div class="flex items-center gap-4 lg:gap-10">
      <nav class="hidden items-center gap-2 lg:flex">
        @php
          $navLink = 'relative text-sm font-semibold tracking-wide transition-all px-4 py-2 rounded-lg';
          $navActive = 'text-primary bg-primary/[0.08] border border-primary/30 shadow-[0_0_12px_rgba(255,215,0,0.12)] text-glow-light';
          $navInactive = 'text-white/70 hover:text-white hover:bg-white/[0.05] border border-transparent';
        @endphp
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('home') ? $navActive : $navInactive }}" href="{{ route('home') }}">{{ __('Home') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('services') ? $navActive : $navInactive }}" href="{{ route('services') }}">{{ __('Services') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('projects') ? $navActive : $navInactive }}" href="{{ route('projects') }}">{{ __('Projects') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('clients') ? $navActive : $navInactive }}" href="{{ route('clients') }}">{{ __('Clients') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('about') ? $navActive : $navInactive }}" href="{{ route('about') }}">{{ __('About') }}</a>
      </nav>
      <a href="{{ route('contact') }}" class="hidden lg:flex h-10 items-center justify-center thin-gold-border bg-background-dark btn-drop-shadow px-4 text-xs md:px-10 md:text-sm font-bold uppercase tracking-wider text-primary transition-all rounded-lg glow-bright">
        {{ __('Contact') }}
      </a>
      {{-- Language Switcher --}}
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="flex h-10 items-center gap-2 rounded-lg border border-white/10 px-3 text-sm font-semibold text-white/70 transition-all hover:text-white hover:border-primary/40 cursor-pointer">
          <span class="text-base leading-none">{{ $currentLocale === 'id' ? '🇮🇩' : '🇬🇧' }}</span>
          <span class="hidden sm:inline uppercase">{{ $currentLocale }}</span>
          <span class="material-symbols-outlined text-sm transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-40 rounded-lg border border-white/10 bg-background-dark/95 backdrop-blur-md shadow-xl overflow-hidden z-50">
          <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'id'])) }}" class="flex items-center gap-3 px-4 py-3 text-sm transition-all {{ $currentLocale === 'id' ? 'text-primary bg-primary/[0.08]' : 'text-white/70 hover:text-white hover:bg-white/[0.05]' }}">
            <span class="text-base">🇮🇩</span>
            {{ __('Indonesian') }}
          </a>
          <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'en'])) }}" class="flex items-center gap-3 px-4 py-3 text-sm transition-all {{ $currentLocale === 'en' ? 'text-primary bg-primary/[0.08]' : 'text-white/70 hover:text-white hover:bg-white/[0.05]' }}">
            <span class="text-base">🇬🇧</span>
            {{ __('English') }}
          </a>
        </div>
      </div>
      <button aria-controls="mobile-menu" aria-expanded="false" class="flex size-11 items-center justify-center rounded-lg border border-white/10 text-primary transition-all hover:text-primary hover:border-primary/40 lg:hidden" id="mobile-menu-toggle" type="button">
        <span class="material-symbols-outlined text-2xl">menu</span>
      </button>
    </div>
  </div>
  <div class="hidden border-t border-white/5 bg-background-dark/95 px-6 py-6 backdrop-blur-md lg:hidden" id="mobile-menu">
    <nav class="flex flex-col gap-1 text-sm font-semibold uppercase tracking-widest">
      @php
        $mobileBase = 'flex items-center gap-3 rounded-lg px-4 py-3 transition-all';
        $mobileActive = 'text-primary bg-primary/[0.08] border border-primary/30 shadow-[0_0_10px_rgba(255,215,0,0.10)] text-glow-light';
        $mobileInactive = 'text-white/70 hover:text-white hover:bg-white/[0.05] border border-transparent';
      @endphp
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('home') ? $mobileActive : $mobileInactive }}" href="{{ route('home') }}">
        @if (Route::currentRouteNamed('home'))
          <span class="block h-1 w-1 rounded-full bg-primary shadow-[0_0_6px_#FFD700]"></span>
        @endif
        {{ __('Home') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('services') ? $mobileActive : $mobileInactive }}" href="{{ route('services') }}">
        @if (Route::currentRouteNamed('services'))
          <span class="block h-1 w-1 rounded-full bg-primary shadow-[0_0_6px_#FFD700]"></span>
        @endif
        {{ __('Services') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('projects') ? $mobileActive : $mobileInactive }}" href="{{ route('projects') }}">
        @if (Route::currentRouteNamed('projects'))
          <span class="block h-1 w-1 rounded-full bg-primary shadow-[0_0_6px_#FFD700]"></span>
        @endif
        {{ __('Projects') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('clients') ? $mobileActive : $mobileInactive }}" href="{{ route('clients') }}">
        @if (Route::currentRouteNamed('clients'))
          <span class="block h-1 w-1 rounded-full bg-primary shadow-[0_0_6px_#FFD700]"></span>
        @endif
        {{ __('Clients') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('about') ? $mobileActive : $mobileInactive }}" href="{{ route('about') }}">
        @if (Route::currentRouteNamed('about'))
          <span class="block h-1 w-1 rounded-full bg-primary shadow-[0_0_6px_#FFD700]"></span>
        @endif
        {{ __('About') }}
      </a>
    </nav>
    <a href="{{ route('contact') }}" class="mt-6 block w-full text-center rounded-lg border border-primary/40 px-4 py-3 text-xs font-bold uppercase tracking-widest text-primary transition-all hover:bg-primary hover:text-background-dark btn-hover-glow">
      {{ __('Contact') }}
    </a>
    {{-- Mobile Language Switcher --}}
    <div class="mt-4 flex gap-2">
      <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'id'])) }}" class="flex-1 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-xs font-bold uppercase tracking-widest transition-all {{ $currentLocale === 'id' ? 'text-primary border border-primary/40 bg-primary/[0.08]' : 'text-white/50 border border-white/10 hover:text-white hover:border-white/30' }}">
        🇮🇩 ID
      </a>
      <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'en'])) }}" class="flex-1 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-xs font-bold uppercase tracking-widest transition-all {{ $currentLocale === 'en' ? 'text-primary border border-primary/40 bg-primary/[0.08]' : 'text-white/50 border border-white/10 hover:text-white hover:border-white/30' }}">
        🇬🇧 EN
      </a>
    </div>
  </div>
  <div class="absolute left-0 right-0 z-40 pointer-events-none">
    <div class="section-separator"></div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuToggle && mobileMenu) {
      menuToggle.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
      });
    }
  });
</script>
