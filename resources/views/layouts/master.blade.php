<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>
<body>
  @include('partials.navbar')
  @include('partials.sidebar')

  <main class="content-wrapper">
    @yield('content')
  </main>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/core.js') }}"></script>
  <script src="{{ asset('assets/js/demo.js') }}"></script>
</body>
</html>
