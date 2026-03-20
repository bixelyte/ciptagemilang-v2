<!doctype html>
<html class="dark" lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>{{ $title ?? 'CIPTA GEMILANG TEKNIK MANDIRI' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-white selection:bg-primary/30">
  <div class="relative flex min-h-screen flex-col overflow-x-hidden">

    {{-- Header --}}
    <x-header />

    {{-- Main Content --}}
    <main class="flex-1">
      {{ $slot }}
    </main>

    {{-- Footer --}}
    <div class="section-separator"></div>
    <x-footer />
  </div>

  @livewireScripts
</body>

</html>
