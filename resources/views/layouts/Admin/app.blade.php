<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SIPERDES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-animate { animation: fadeInUp 0.2s ease-out; }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-green-900 text-white transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-2xl">
            
            <div class="p-6 flex flex-col items-center border-b border-green-800">
                <img src="{{ asset('assets/img/logo.png') }}" class="w-16 h-16 mb-2 rounded-xl" alt="Logo">
                <h2 class="text-lg font-bold tracking-widest text-green-100">~SIPERDES~</h2>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                @php
                    $menus = [
                        ['route' => 'dashboard.index', 'icon' => '🏠', 'label' => 'Dashboard'],
                        ['route' => 'user.index', 'icon' => '👩🏻‍🦰', 'label' => 'User'],
                        ['route' => 'warga.index', 'icon' => '👨‍👩‍👧‍👦', 'label' => 'Warga'],
                        ['route' => 'perangkat-desa.index', 'icon' => '👥', 'label' => 'Perangkat'],
                        ['route' => 'lembaga.index', 'icon' => '🏢', 'label' => 'Lembaga'],
                        ['route' => 'jabatan-lembaga.index', 'icon' => '📊', 'label' => 'Jabatan'],
                        ['route' => 'anggota-lembaga.index', 'icon' => '⚜️', 'label' => 'Anggota'],
                    ];
                @endphp

                @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs(explode('.', $menu['route'])[0].'*') ? 'bg-green-700 shadow-inner scale-105' : 'hover:bg-green-800' }}">
                    <span class="text-xl">{{ $menu['icon'] }}</span>
                    <span class="font-medium text-sm">{{ $menu['label'] }}</span>
                </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-green-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-semibold shadow">
                        <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div 
            x-show="sidebarOpen" 
            x-cloak
            @click="sidebarOpen = false" 
            class="fixed inset-0 bg-black/50 z-40 md:hidden transition-opacity duration-300">
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">
            
            <header class="bg-white border-b border-gray-200 shadow-sm px-4 md:px-8 py-3 flex items-center justify-between z-30">
                <button @click="sidebarOpen = true" class="p-2 text-gray-500 hover:text-green-700 md:hidden transition-colors">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <div class="hidden md:block">
                    <h1 class="text-xl font-bold text-gray-800">Sistem Perangkat Desa</h1>
                </div>

                <div class="flex items-center space-x-3 md:space-x-6">
                    <div class="relative" x-data="{ notifOpen: false }">
                        <button @click="notifOpen = !notifOpen" class="relative p-2 text-gray-400 hover:text-green-600">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center font-bold">3</span>
                        </button>
                        <div x-show="notifOpen" @click.outside="notifOpen = false" x-cloak class="absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 dropdown-animate">
                            <div class="p-4 border-b font-bold text-gray-700">Notifikasi Terbaru</div>
                            <div class="max-h-60 overflow-y-auto">
                                <a href="#" class="block p-4 hover:bg-gray-50 text-sm border-b">🔔 Warga baru terdaftar <br><span class="text-xs text-gray-400">2 menit lalu</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 focus:outline-none bg-gray-50 p-1 pr-3 rounded-full hover:bg-gray-100 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=10B981&color=fff" class="w-8 h-8 rounded-full">
@auth
    <span class="hidden sm:inline text-gray-700 font-semibold text-sm">
        Hi, {{ Auth::user()->name }}
    </span>
@else
    <span class="hidden sm:inline text-gray-700 font-semibold text-sm">
        Hi, Guest
    </span>
@endauth                            <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform" :class="profileOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="profileOpen" @click.outside="profileOpen = false" x-cloak class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 dropdown-animate">
                            <div class="p-4 border-b">
                                <p class="text-sm font-bold text-gray-800">Administrator</p>
                                <p class="text-xs text-gray-500">admin@siperdes.id</p>
                            </div>
                            <div class="p-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 rounded-lg">⚙️ Pengaturan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-7xl mx-auto overflow-x-hidden">
                    @yield('content')
                </div>
            </main>

            <footer class="bg-white border-t p-4 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} SIPERDES Desa Bina Maju. Versi 1.0.0
            </footer>
        </div>
    </div>

    <a href="https://wa.me/6281265719003" target="_blank" 
       class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 text-white rounded-full shadow-2xl flex items-center justify-center hover:bg-green-600 transition-all hover:scale-110 active:scale-95 z-40">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

</body>
</html>