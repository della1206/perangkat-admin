<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Bina Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            Bina Desa
        </div>

        <nav class="flex-1 p-4">
            <ul class="space-y-3">

                <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-gray-700">🏠 Dashboard</a></li>
                <li><a class="block p-2 rounded hover:bg-gray-700">👩🏻‍🦰 User</a></li>
                <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-gray-700">👨‍👩‍👧‍👦 Warga</a></li>
                <li><a href="{{ route('lembaga.index') }}" class="block p-2 rounded hover:bg-gray-700">🏢 Lembaga Desa</a></li>
                {{-- <li><a href="{{ route('perangkat.index') }}" class="block p-2 rounded hover:bg-gray-700">⚙️ Perangkat Desa</a></li> --}}
            </ul>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full p-2 bg-red-600 rounded text-center hover:bg-red-700">Keluar</button>
            </form>
        </div>
    </aside>

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col overflow-y-auto">

        <!-- Header Navbar -->
        <header class="flex justify-between items-center bg-white shadow px-6 py-3">
            <!-- Tombol menu (jika dibutuhkan) -->
            <div>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Bagian kanan: ikon & profil admin -->
            <div class="flex items-center space-x-6">
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bell"></i>
                </button>

                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-envelope"></i>
                </button>

                <div class="flex items-center space-x-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(session('admin_name') ?? 'Admin Desa') }}&background=0D8ABC&color=fff" 
                         alt="Avatar" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700 font-medium">
                        Hi, {{ session('admin_name') ?? 'Admin Desa' }}
                    </span>
                </div>
            </div>
        </header>

        <!-- Isi konten halaman -->
        <main class="p-8 bg-gray-100 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>
