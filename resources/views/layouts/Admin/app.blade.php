<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Bina Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CSS Custom -->
    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-bounce {
            animation: bounce 1s ease-in-out 3;
        }

        #notificationDropdown, #profileDropdown {
            transition: all 0.2s ease-in-out;
            transform-origin: top right;
        }

        #notificationDropdown:not(.hidden),
        #profileDropdown:not(.hidden) {
            animation: fadeInUp 0.2s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
            padding: 1rem 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .pagination-info {
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .pagination-pages {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .pagination-prev-next {
            display: flex;
            gap: 1rem;
        }

        .page-link {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s;
        }

        .page-link:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }

        .page-link.active {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }

        .page-link.disabled {
            color: #9ca3af;
            cursor: not-allowed;
        }

        .page-link.disabled:hover {
            background-color: transparent;
            border-color: #d1d5db;
        }
    </style>
</head>

<body class="bg-green-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-800 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            Perangkat Desa
        </div>

        <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('dashboard.*') ? 'bg-dark green-700' : '' }}">🏠 Dashboard</a></li>
                <li><a href="{{ route('user.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('user.*') ? 'bg-dark green-700' : '' }}">👩🏻‍🦰 User</a></li>
                <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('warga.*') ? 'bg-dark green-700' : '' }}">👨‍👩‍👧‍👦 Warga</a></li>
                <li><a href="{{ route('lembaga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('lembaga.*') ? 'bg-dark green-700' : '' }}">🏢 Lembaga Desa</a></li>
                <li><a href="{{ route('jabatan-lembaga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('jabatan.*') ? 'bg-dark green-700' : '' }}">🔱 Jabatan Desa</a></li>
                 <li><a href="{{ route('perangkat_desa.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('perangkat_desa.*') ? 'bg-green-700' : '' }}"> 🧑‍🌾 Perangkat Desa</a></li>
            </ul>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full p-2 bg-green-600 rounded text-center hover:bg-yellow-500">Keluar</button>
            </form>
        </div>
    </aside>

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col overflow-y-auto">

        <!-- Header Navbar -->
        <header class="flex justify-between items-center bg-white shadow px-6 py-3">

            <!-- Tombol menu -->
            <div>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Bagian kanan -->
            <div class="flex items-center space-x-6">

                <!-- 🔔 NOTIFICATION BUTTON (DITAMBAHKAN) -->
                <div class="relative cursor-pointer" id="notificationButton">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>

                    <!-- Titik merah jumlah notifikasi -->
                    <span class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded-full">
                        3
                    </span>
                </div>

                <!-- 🔔 NOTIFICATION DROPDOWN (DITAMBAHKAN) -->
                <div id="notificationDropdown"
                     class="absolute right-28 mt-40 w-64 bg-white shadow-xl border border-gray-200 rounded-lg hidden z-50">

                    <div class="p-3 border-b font-semibold text-gray-700">
                        Notifikasi
                    </div>

                    <ul class="max-h-60 overflow-y-auto text-sm">

                        <li class="px-4 py-3 border-b hover:bg-gray-100 cursor-pointer">
                            🔔 Warga baru terdaftar
                            <p class="text-xs text-gray-500">2 menit lalu</p>
                        </li>

                        <li class="px-4 py-3 border-b hover:bg-gray-100 cursor-pointer">
                            📌 Ada lembaga yang diperbarui
                            <p class="text-xs text-gray-500">10 menit lalu</p>
                        </li>

                        <li class="px-4 py-3 hover:bg-gray-100 cursor-pointer">
                            📝 jabatan desa ditambahkan
                            <p class="text-xs text-gray-500">1 jam lalu</p>
                        </li>

                    </ul>

                </div>

                <!-- PROFILE -->
                <div class="flex items-center space-x-2 cursor-pointer" id="profileButton">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin Desa') }}&background=0D8ABC&color=fff"
                         alt="Avatar" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700 font-medium">
                        Hi, {{ auth()->user()->name ?? 'Admin Desa' }}
                    </span>
                    <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                </div>

                <!-- PROFILE DROPDOWN -->
                <div id="profileDropdown" class="absolute right-6 mt-32 w-48 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-50">
                    <div class="p-4 border-b border-green-200">
                        <p class="font-medium text-gray-800">{{ auth()->user()->name ?? 'Della' }}</p>
                        <p class="text-sm text-gray-600">Administrator</p>
                    </div>
                    <div class="p-2">
                        <a href="#" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100 rounded transition duration-200">
                            <i class="fas fa-user-circle mr-2"></i>Profil Saya
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 rounded transition duration-200">
                            <i class="fas fa-cog mr-2"></i>Pengaturan
                        </a>
                    </div>
                    <div class="p-2 border-t border-gray-200">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded transition duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- ISI HALAMAN -->
        <main class="p-8 bg-gray-100 flex-1">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-white border-t border-gray-200 py-4 px-6">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} Aplikasi Bina Desa. All rights reserved.
                </div>
                <div class="text-sm text-gray-600">
                    Versi 1.0.0
                </div>
            </div>
        </footer>
    </div>

    <!-- WHATSAPP FLOAT -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/6281265719003?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Aplikasi%20Bina%20Desa."
           target="_blank"
           class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center hover:bg-green-600 transition duration-300 transform hover:scale-110 block animate-bounce">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>

        <div class="absolute bottom-16 right-0 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 transition-opacity duration-300 pointer-events-none"
             id="whatsappTooltip">
            Hubungi Admin Desa
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>

        // 🔔 Notification Toggle
        const notifBtn = document.getElementById('notificationButton');
        const notifDrop = document.getElementById('notificationDropdown');

        notifBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            notifDrop.classList.toggle('hidden');
        });

        // Profile Dropdown
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', function(event) {
            event.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        // Click outside close
        document.addEventListener('click', function() {
            notifDrop.classList.add('hidden');
            profileDropdown.classList.add('hidden');
        });

        // WhatsApp Tooltip
        const whatsappButton = document.querySelector('a[href*="wa.me"]');
        const whatsappTooltip = document.getElementById('whatsappTooltip');

        whatsappButton.addEventListener('mouseenter', () => whatsappTooltip.classList.remove('opacity-0'));
        whatsappButton.addEventListener('mouseleave', () => whatsappTooltip.classList.add('opacity-0'));

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => whatsappButton.classList.remove('animate-bounce'), 3000);
        });

    </script>

</body>
</html>