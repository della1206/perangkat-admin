<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="d-flex">
  {{-- Sidebar --}}
  <aside class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
    <h5 class="text-center mb-4">Menu</h5>
    <ul class="nav flex-column">
      @foreach ($menuData[0]->menu ?? [] as $menu)
        <li class="nav-item mb-2">
          <a href="{{ url($menu->route) }}" class="nav-link text-white">
            <i class="{{ $menu->icon }}"></i> {{ $menu->name }}
          </a>
        </li>
      @endforeach
    </ul>
  </aside>

  {{-- Content --}}
  <main class="flex-grow-1 p-4">
    @yield('content')
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  @yield('scripts')
</body>
</html>
