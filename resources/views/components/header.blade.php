@php
  $companyShortName = \App\Models\CompanySetting::get('company_short_name', 'CIPTA GEMILANG');
  $companyTagline = \App\Models\CompanySetting::get('company_tagline', 'TEKNIK MANDIRI');
  $currentLocale = app()->getLocale();
@endphp

<header class="fixed top-0 z-50 w-full border-b border-white/5 bg-background-dark/80 backdrop-blur-md">
  <div class="mx-auto flex max-w-[1440px] items-center justify-between px-4 py-3 lg:px-20 lg:py-6">
    <a href="/" class="flex items-center gap-2 lg:gap-3">
      <div class="flex items-center h-8 w-8 lg:h-14 lg:w-14">
        <img alt="CIPTA GEMILANG logo" class="h-full w-full object-contain p-0.5 lg:p-1" src="{{ asset('images/logo.svg') }}" />
      </div>
      <h2 class="text-xs lg:text-sm font-extrabold uppercase tracking-widest text-white leading-snug">
        {{ $companyShortName }} <span class="hidden lg:inline"><br /></span>
        <span class="text-corporate-orange inline lg:block">{{ $companyTagline }}</span>
      </h2>
    </a>
    <div class="flex items-center gap-3 lg:gap-10">
      <nav class="hidden items-center gap-1 lg:flex">
        @php
          $navLink = 'relative flex items-center justify-center h-10 px-4 text-xs md:px-6 md:text-sm font-bold uppercase tracking-wider transition-all rounded-lg';
          $navActive = 'thin-gold-border bg-background-dark btn-drop-shadow text-primary glow-bright';
          $navInactive = 'text-white hover:text-primary border border-transparent';
          $isHome = Route::currentRouteNamed('home');
        @endphp
        <a class="{{ $navLink }} {{ $isHome ? $navActive : $navInactive }}" href="{{ $isHome ? '#' : route('home') }}">{{ __('Home') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('about') ? $navActive : $navInactive }}" href="{{ $isHome ? '#about' : route('about') }}">{{ __('About Us') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('services') ? $navActive : $navInactive }}" href="{{ $isHome ? '#services' : route('services') }}">{{ __('Services') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('projects') ? $navActive : $navInactive }}" href="{{ $isHome ? '#projects' : route('projects') }}">{{ __('Projects') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('clients') ? $navActive : $navInactive }}" href="{{ $isHome ? '#clients' : route('clients') }}">{{ __('Clients') }}</a>
        <a class="{{ $navLink }} {{ Route::currentRouteNamed('contact') ? $navActive : $navInactive }}" href="{{ $isHome ? '#contact' : route('contact') }}">{{ __('Contact') }}</a>
      </nav>
      {{-- Language Switcher --}}
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="flex h-8 lg:h-10 items-center gap-1 lg:gap-2 rounded-md lg:rounded-lg border border-white/10 px-2 lg:px-3 text-xs lg:text-sm font-semibold text-white/70 transition-all hover:text-white hover:border-primary/40 cursor-pointer">
          <span class="text-sm lg:text-base leading-none">{{ $currentLocale === 'id' ? '🇮🇩' : '🇬🇧' }}</span>
          <span class="hidden sm:inline uppercase">{{ $currentLocale }}</span>
          <span class="material-symbols-outlined text-xs lg:text-sm transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
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
      <button aria-controls="mobile-menu" aria-expanded="false" class="flex size-8 lg:size-11 items-center justify-center rounded-md lg:rounded-lg border border-white/10 text-primary transition-all hover:text-primary hover:border-primary/40 lg:hidden" id="mobile-menu-toggle" type="button">
        <span class="material-symbols-outlined text-lg lg:text-2xl">menu</span>
      </button>
    </div>
  </div>
  <div class="hidden border-t border-white/5 bg-background-dark/95 px-4 py-4 backdrop-blur-md lg:hidden" id="mobile-menu">
    <nav class="flex flex-col gap-1">
      @php
        $mobileBase = 'flex items-center justify-center h-10 px-4 text-[10px] font-bold uppercase tracking-widest transition-all rounded-md';
        $mobileActive = 'thin-gold-border bg-background-dark btn-drop-shadow text-primary glow-bright';
        $mobileInactive = 'text-white hover:text-primary border border-transparent';
      @endphp
      <a class="{{ $mobileBase }} {{ $isHome ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#' : route('home') }}">
        {{ __('Home') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('about') ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#about' : route('about') }}">
        {{ __('About Us') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('services') ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#services' : route('services') }}">
        {{ __('Services') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('projects') ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#projects' : route('projects') }}">
        {{ __('Projects') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('clients') ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#clients' : route('clients') }}">
        {{ __('Clients') }}
      </a>
      <a class="{{ $mobileBase }} {{ Route::currentRouteNamed('contact') ? $mobileActive : $mobileInactive }}" href="{{ $isHome ? '#contact' : route('contact') }}">
        {{ __('Contact') }}
      </a>
    </nav>
    {{-- Mobile Language Switcher --}}
    <div class="mt-2 flex gap-2">
      <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'id'])) }}" class="flex-1 flex items-center justify-center gap-2 rounded-md h-10 px-4 text-[10px] font-bold uppercase tracking-widest transition-all {{ $currentLocale === 'id' ? 'text-primary border border-primary/40 bg-primary/[0.08]' : 'text-white/50 border border-white/10 hover:text-white hover:border-white/30' }}">
        🇮🇩 ID
      </a>
      <a href="{{ route(Route::currentRouteName() ?: 'home', array_merge(request()->route() ? request()->route()->parameters() : [], ['locale' => 'en'])) }}" class="flex-1 flex items-center justify-center gap-2 rounded-md h-10 px-4 text-[10px] font-bold uppercase tracking-widest transition-all {{ $currentLocale === 'en' ? 'text-primary border border-primary/40 bg-primary/[0.08]' : 'text-white/50 border border-white/10 hover:text-white hover:border-white/30' }}">
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

    // Smooth scroll for anchor links
    document.documentElement.style.scrollBehavior = 'smooth';
    
    // Close mobile menu when an anchor link is clicked
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    @if($isHome)
      const desktopActive = '{!! $navActive !!}'.split(' ');
      const desktopInactive = '{!! $navInactive !!}'.split(' ');
      const mobileActive = '{!! $mobileActive !!}'.split(' ');
      const mobileInactive = '{!! $mobileInactive !!}'.split(' ');

      const desktopLinks = document.querySelectorAll('nav.hidden.lg\\:flex a[href^="#"]');
      const mobileLinks = document.querySelectorAll('#mobile-menu nav a[href^="#"]');

      function updateActiveMenu() {
          let currentScroll = window.scrollY;
          let currentSection = '#';

          document.querySelectorAll('section[id]').forEach(sec => {
              // Offset of 300 to trigger active state slightly before reaching the top
              if (currentScroll >= (sec.offsetTop - 300)) {
                  currentSection = '#' + sec.getAttribute('id');
              }
          });

          // Fallback for hero section
          if (currentScroll < 300) {
              currentSection = '#';
          }

          desktopLinks.forEach(link => {
              if (link.getAttribute('href') === currentSection) {
                  link.classList.remove(...desktopInactive);
                  link.classList.add(...desktopActive);
              } else {
                  link.classList.remove(...desktopActive);
                  link.classList.add(...desktopInactive);
              }
          });

          mobileLinks.forEach(link => {
              if (link.getAttribute('href') === currentSection) {
                  link.classList.remove(...mobileInactive);
                  link.classList.add(...mobileActive);
              } else {
                  link.classList.remove(...mobileActive);
                  link.classList.add(...mobileInactive);
              }
          });
      }

      window.addEventListener('scroll', updateActiveMenu);
      // Run once on load
      updateActiveMenu();
    @endif
  });
</script>
