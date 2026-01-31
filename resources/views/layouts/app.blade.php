<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'asylummade')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/polish.css" rel="stylesheet">
</head>
<body>

@include('partials.nav')

<main>
  @yield('content')
</main>

@include('partials.footer')

<script src="/assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
