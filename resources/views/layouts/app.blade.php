<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>@yield('title', 'Asylum Made Track & Field — Riverview, Florida')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Local context / SEO --}}
  <meta name="description"
        content="@yield('meta_description', 'Asylum Made Track is a locally operated track league based in Riverview, Florida, focused on fair competition, clear rules, and consistent race operations.')">

  <meta name="geo.region" content="US-FL">
  <meta name="geo.placename" content="Riverview, Florida">
  <meta name="geo.position" content="27.8661;-82.3265">
  <meta name="ICBM" content="27.8661, -82.3265">

  {{-- Theme colors --}}
  <meta name="theme-color" content="#4b2e83">
  <meta name="msapplication-TileColor" content="#4b2e83">

  {{-- Favicon --}}
  <link rel="icon" type="image/svg+xml" href="/assets/images/icons/favicon.svg">
  <link rel="apple-touch-icon" href="/assets/images/icons/favicon.svg">

  {{-- Bootstrap 5 (CDN, HTML5-native) --}}
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >

  {{-- Site polish --}}
  <link rel="stylesheet" href="{{ asset('assets/css/polish.css') }}">
  
  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
  </style>

  @stack('head')
  @stack('styles')
</head>
<body>

@include('partials.nav')

<main role="main">
  @yield('content')
</main>

@include('partials.footer')

{{-- Bootstrap bundle (includes Popper) --}}
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>

@stack('scripts')

</body>
</html>
