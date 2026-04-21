@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Bina Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-bounce { animation: bounce 1s ease-in-out 3; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-fadeInUp { animation: fadeInUp 0.2s ease-out; }

        /* Mencegah scroll horizontal di HP */
        body, html { overflow-x: hidden; width: 100%; }
    </style>
</head>

<body class="bg-green-100 min-h-screen" x-data="{ open: false }">

    <div class="flex min-h-screen overflow-x-hidden relative">
        
        <div x-show="open" x-cloak @click="open = false" 
             class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden transition-opacity">
        </div>

        <aside :class="open ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-green-800 text-white flex flex-col transform transition duration-300 ease-in-out md:relative md:translate-x-0 shadow-xl">
            
            <div class="p-4 border-b border-green-700 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logoo.png.webp') }}" alt="Logo Desa" class="w-10 h-10 rounded-lg shadow-lg">
                    <span class="font-bold">~SIPERDES~</span>
                </div>
                <button @click="open = false" class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-3">
                    <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('dashboard.*') ? 'bg-green-900' : '' }}">🏠 Dashboard</a></li>
                    <li class="border-t border-green-600 my-2 pt-2 text-xs text-green-300 uppercase">Master Data</li>
                    <li><a href="{{ route('user.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('user.*') ? 'bg-green-900' : '' }}">👩🏻‍🦰 User</a></li>
                    <li><a href="{{ route('rw.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('rw.*') ? 'bg-green-900' : '' }}">🧑🏼‍💼 Rw</a></li>
                    <li><a href="{{ route('rt.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('rt.*') ? 'bg-green-900' : '' }}">🧑🏼‍💼 Rt</a></li>
                    <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('warga.*') ? 'bg-green-900' : '' }}">👨‍👩‍👧‍👦 Warga</a></li>
                    <li class="border-t border-green-600 my-2 pt-2 text-xs text-green-300 uppercase">Kelembagaan</li>
                    <li><a href="{{ route('perangkat-desa.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('perangkat-desa.*') ? 'bg-green-900' : '' }}">👥 Perangkat Desa</a></li>
                    <li><a href="{{ route('lembaga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('lembaga.*') ? 'bg-green-900' : '' }}">🏢 Lembaga Desa</a></li>
                    <li><a href="{{ route('jabatan-lembaga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('jabatan.*') ? 'bg-green-900' : '' }}">🔱 Jabatan Desa</a></li>
                    <li><a href="{{ route('anggota-lembaga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('anggota-lembaga.*') ? 'bg-green-900' : '' }}">⚜️ Anggota lembaga</a></li>
                </ul>
            </nav>

            <div class="p-4 border-t border-green-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full p-2 bg-red-600 rounded text-center hover:bg-red-700 transition font-bold text-sm">Keluar</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 w-full">

            <header class="flex justify-between items-center bg-white shadow-sm px-4 md:px-6 py-3 sticky top-0 z-30">
                <button @click="open = !open" class="text-gray-500 hover:text-green-700 focus:outline-none p-2 bg-gray-100 rounded-md">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <div class="flex items-center space-x-4 md:space-x-6">
                    <div class="relative cursor-pointer" id="notificationButton">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] px-1.5 rounded-full font-bold">3</span>
                    </div>

                    <div class="flex items-center space-x-2 cursor-pointer" id="profileButton">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Della') }}&background=0D8ABC&color=fff"
                             alt="Avatar" class="w-8 h-8 rounded-full border">
                        <span class="hidden md:inline text-gray-700 font-medium text-sm">Hi, {{ auth()->user()->name ?? 'Della' }}</span>
                        <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                    </div>
                </div>
            </header>

            <main class="p-4 md:p-8 bg-gray-100 flex-1 w-full overflow-x-hidden">
                <div class="w-full animate-fadeInUp">
                    @yield('content')
                </div>
            </main>

            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 gap-2 text-center">
                    <div>&copy; {{ date('Y') }} Sistem Perangkat Desa. All rights reserved.</div>
                    <div>Versi 1.0.0</div>
                </div>
            </footer>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/6281265719003" target="_blank"
           class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center hover:bg-green-600 transition duration-300 transform hover:scale-110 animate-bounce">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>
    </div>

    <div id="notificationDropdown" class="absolute right-12 mt-14 w-64 bg-white shadow-xl border rounded-lg hidden z-50">
        <div class="p-3 border-b font-semibold text-sm text-gray-700">Notifikasi</div>
        <ul class="max-h-60 overflow-y-auto text-xs">
            <li class="px-4 py-3 border-b hover:bg-gray-50 cursor-pointer">🔔 Warga baru terdaftar</li>
        </ul>
    </div>

    <div id="profileDropdown" class="absolute right-4 mt-14 w-64 bg-white shadow-xl border rounded-lg hidden z-50">
        <div class="p-4 border-b bg-green-50">
            <p class="font-bold text-gray-800 text-sm">{{ auth()->user()->name ?? 'Della' }}</p>
            <p class="text-xs text-gray-500 italic">Administrator</p>
        </div>
        <div class="p-2">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 rounded">Profil Saya</a>
            <form action="{{ route('logout') }}" method="POST" class="border-t mt-1 pt-1">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded">Keluar</button>
            </form>
        </div>
    </div>

    <script>
        const setupDropdown = (btnId, dropId) => {
            const btn = document.getElementById(btnId);
            const drop = document.getElementById(dropId);
            btn.addEventListener('click', (e) => { e.stopPropagation(); drop.classList.toggle('hidden'); });
        };
        setupDropdown('notificationButton', 'notificationDropdown');
        setupDropdown('profileButton', 'profileDropdown');
        document.addEventListener('click', () => {
            document.getElementById('notificationDropdown').classList.add('hidden');
            document.getElementById('profileDropdown').classList.add('hidden');
        });
    </script>
</body>
</html>