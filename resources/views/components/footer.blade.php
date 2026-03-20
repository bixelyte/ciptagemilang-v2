@php
  $companyName = \App\Models\CompanySetting::get('company_name', 'PT. CIPTA GEMILANG TEKNIK MANDIRI');
  $companyDescription = \App\Models\CompanySetting::get('company_description', '');
  $companyAddress = \App\Models\CompanySetting::get('company_address', '');
  $companyPhone = \App\Models\CompanySetting::get('company_phone', '');
@endphp

<footer class="bg-background-dark px-6 py-24 lg:px-20 relative overflow-hidden">
  <div class="mx-auto max-w-[1440px]">
    <div class="grid grid-cols-1 gap-16 lg:grid-cols-4">
      <div class="lg:col-span-2">
        <div class="mb-10">
          <h2 class="text-lg font-extrabold uppercase tracking-widest text-white leading-tight">
            {{ $companyName }}
          </h2>
        </div>
        <p class="mb-10 max-w-sm font-light leading-relaxed text-white/50 text-base">
          {{ $companyDescription }}
        </p>
        <div class="flex gap-5">
          <div class="flex size-11 items-center justify-center rounded-full border border-primary/20 text-primary hover:bg-primary hover:text-background-dark transition-all cursor-pointer">
            <span class="material-symbols-outlined text-xl">share</span>
          </div>
          <div class="flex size-11 items-center justify-center rounded-full border border-primary/20 text-primary hover:bg-primary hover:text-background-dark transition-all cursor-pointer">
            <span class="material-symbols-outlined text-xl">mail</span>
          </div>
        </div>
      </div>
      <div>
        <h4 class="mb-8 text-sm font-bold uppercase tracking-[0.3em] text-primary">{{ __('Quick Links') }}</h4>
        <ul class="flex flex-col gap-5 text-sm font-medium text-white/50">
          <li><a class="hover:text-primary transition-colors flex items-center gap-2" href="{{ route('home') }}"><span class="size-1 rounded-full bg-white/20"></span> {{ __('Home') }}</a></li>
          <li><a class="hover:text-primary transition-colors flex items-center gap-2" href="{{ route('services') }}"><span class="size-1 rounded-full bg-white/20"></span> {{ __('Services') }}</a></li>
          <li><a class="hover:text-primary transition-colors flex items-center gap-2" href="{{ route('projects') }}"><span class="size-1 rounded-full bg-white/20"></span> {{ __('Projects') }}</a></li>
          <li><a class="hover:text-primary transition-colors flex items-center gap-2" href="{{ route('about') }}"><span class="size-1 rounded-full bg-white/20"></span> {{ __('About Us') }}</a></li>
          <li><a class="hover:text-primary transition-colors flex items-center gap-2" href="{{ route('contact') }}"><span class="size-1 rounded-full bg-white/20"></span> {{ __('Contact') }}</a></li>
        </ul>
      </div>
      <div>
        <h4 class="mb-8 text-sm font-bold uppercase tracking-[0.3em] text-primary">{{ __('Contact') }}</h4>
        <ul class="flex flex-col gap-6 text-sm font-medium text-white/50">
          <li class="flex items-start gap-4">
            <span class="material-symbols-outlined text-primary text-xl">location_on</span>
            <span>{!! nl2br(e($companyAddress)) !!}</span>
          </li>
          <li class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary text-xl">call</span>
            {{ $companyPhone }}
          </li>
        </ul>
      </div>
    </div>
    <div class="mt-24 flex flex-col items-center justify-between gap-8 border-t border-white/5 pt-12 lg:flex-row">
      <p class="text-[11px] uppercase tracking-[0.2em] text-white/20">
        &copy; {{ date('Y') }} {{ $companyName }}. {{ __('All rights reserved.') }}
      </p>
      <div class="flex gap-10 text-[11px] uppercase tracking-[0.2em] text-white/20">
        <a class="hover:text-primary transition-colors" href="#">{{ __('Privacy Policy') }}</a>
        <a class="hover:text-primary transition-colors" href="#">{{ __('Terms of Service') }}</a>
      </div>
    </div>
  </div>
</footer>
