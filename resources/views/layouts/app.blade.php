<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Bina Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
                Perangkat Desa
        </div>

        <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-gray-700">🏠 Dashboard</a></li>
                <li><a href="{{ route('user.index') }}" class="block p-2 rounded hover:bg-gray-700">👩🏻‍🦰 User</a></li>
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
                <!-- Notifikasi Bell -->
                <div class="relative">
                    <button id="notificationButton" class="text-gray-500 hover:text-gray-700 relative">
                        <i class="fas fa-bell text-xl"></i>
                        <!-- Notification Badge -->
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                            3
                        </span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                            <span class="text-xs text-gray-500">3 pesan belum dibaca</span>
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            <!-- Notification 1 -->
                            <a href="#" class="block p-4 border-b border-gray-100 hover:bg-blue-50 transition duration-200">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-plus text-blue-500"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">User Baru Terdaftar</p>
                                        <p class="text-xs text-gray-600">Sani baru saja mendaftar sebagai user</p>
                                        <span class="text-xs text-blue-500">2 menit lalu</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Notification 2 -->
                            <a href="{{ route('warga.index') }}" class="block p-4 border-b border-gray-100 hover:bg-green-50 transition duration-200">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-users text-green-500"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Data Warga Diperbarui</p>
                                        <p class="text-xs text-gray-600">5 data warga baru ditambahkan</p>
                                        <span class="text-xs text-green-500">1 jam lalu</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Notification 3 -->
                            <a href="{{ route('lembaga.index') }}" class="block p-4 hover:bg-purple-50 transition duration-200">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-building text-purple-500"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Lembaga Desa Update</p>
                                        <p class="text-xs text-gray-600">Lembaga Karang Taruna telah diperbarui</p>
                                        <span class="text-xs text-purple-500">3 jam lalu</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 border-t border-gray-200 bg-gray-50">
                            <a href="#" class="block text-center text-sm text-blue-600 font-medium hover:text-blue-700">
                                Lihat Semua Notifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="relative">
                    <button id="messageButton" class="text-gray-500 hover:text-gray-700 relative">
                        <i class="fas fa-envelope text-xl"></i>
                        <!-- Message Badge -->
                        <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                            2
                        </span>
                    </button>

                    <!-- Message Dropdown -->
                    <div id="messageDropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Pesan</h3>
                            <span class="text-xs text-gray-500">2 pesan belum dibaca</span>
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            <!-- Message 1 -->
                            <a href="#" class="block p-4 border-b border-gray-100 hover:bg-yellow-50 transition duration-200">
                                <div class="flex items-start space-x-3">
                                    <img src="https://ui-avatars.com/api/?name=Sani+Warga&background=F59E0B&color=fff"
                                         alt="Sani" class="w-10 h-10 rounded-full flex-shrink-0">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <p class="text-sm font-medium text-gray-800">Sani Warga</p>
                                            <span class="text-xs text-gray-500">10:30</span>
                                        </div>
                                        <p class="text-xs text-gray-600 truncate">Bagaimana cara mengupdate data diri saya di aplikasi?</p>
                                        <span class="inline-block mt-1 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">Butuh Balasan</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Message 2 -->
                            <a href="#" class="block p-4 hover:bg-green-50 transition duration-200">
                                <div class="flex items-start space-x-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin+Desa&background=10B981&color=fff"
                                         alt="Admin" class="w-10 h-10 rounded-full flex-shrink-0">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <p class="text-sm font-medium text-gray-800">Admin Desa</p>
                                            <span class="text-xs text-gray-500">09:15</span>
                                        </div>
                                        <p class="text-xs text-gray-600 truncate">Meeting rutin bulanan akan dilaksanakan besok</p>
                                        <span class="inline-block mt-1 px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Info</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 border-t border-gray-200 bg-gray-50">
                            <a href="#" class="block text-center text-sm text-blue-600 font-medium hover:text-blue-700">
                                Lihat Semua Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="flex items-center space-x-2 cursor-pointer" id="profileButton">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(session('admin_name') ?? 'Admin Desa') }}&background=0D8ABC&color=fff"
                         alt="Avatar" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700 font-medium">
                        Hi, {{ session('admin_name') ?? 'Admin Desa' }}
                    </span>
                    <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                </div>

                <!-- Profile Dropdown -->
                <div id="profileDropdown" class="absolute right-6 mt-32 w-48 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-50">
                    <div class="p-4 border-b border-gray-200">
                        <p class="font-medium text-gray-800">{{ session('admin_name') ?? 'Admin Desa' }}</p>
                        <p class="text-sm text-gray-600">Administrator</p>
                    </div>
                    <div class="p-2">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-user-circle mr-2"></i>Profil Saya
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-cog mr-2"></i>Pengaturan
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-bell mr-2"></i>Notifikasi
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

        <!-- Isi konten halaman -->
        <main class="p-8 bg-gray-100 flex-1">
            @yield('content')
        </main>
    </div>

    <!-- Floating WhatsApp Button - Langsung buka WhatsApp -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Aplikasi%20Bina%20Desa."
           target="_blank"
           class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center hover:bg-green-600 transition duration-300 transform hover:scale-110 block animate-bounce">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>

        <!-- Tooltip (opsional) -->
        <div class="absolute bottom-16 right-0 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 transition-opacity duration-300 pointer-events-none"
             id="whatsappTooltip">
            Hubungi Admin Desa
        </div>
    </div>

    <script>
        // Notification Dropdown
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');

        notificationButton.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
            // Close other dropdowns
            messageDropdown.classList.add('hidden');
            profileDropdown.classList.add('hidden');
        });

        // Message Dropdown
        const messageButton = document.getElementById('messageButton');
        const messageDropdown = document.getElementById('messageDropdown');

        messageButton.addEventListener('click', function(e) {
            e.stopPropagation();
            messageDropdown.classList.toggle('hidden');
            // Close other dropdowns
            notificationDropdown.classList.add('hidden');
            profileDropdown.classList.add('hidden');
        });

        // Profile Dropdown
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
            // Close other dropdowns
            notificationDropdown.classList.add('hidden');
            messageDropdown.classList.add('hidden');
        });

        // WhatsApp Tooltip
        const whatsappButton = document.querySelector('a[href*="wa.me"]');
        const whatsappTooltip = document.getElementById('whatsappTooltip');

        whatsappButton.addEventListener('mouseenter', function() {
            whatsappTooltip.classList.remove('opacity-0');
            whatsappTooltip.classList.add('opacity-100');
        });

        whatsappButton.addEventListener('mouseleave', function() {
            whatsappTooltip.classList.remove('opacity-100');
            whatsappTooltip.classList.add('opacity-0');
        });

        // Close all dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }
            if (!messageButton.contains(event.target) && !messageDropdown.contains(event.target)) {
                messageDropdown.classList.add('hidden');
            }
            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // Prevent dropdowns from closing when clicking inside
        notificationDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        messageDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Remove bounce animation after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                whatsappButton.classList.remove('animate-bounce');
            }, 3000);
        });
    </script>

    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-bounce {
            animation: bounce 1s ease-in-out 3;
        }

        /* Smooth transitions for dropdowns */
        #notificationDropdown, #messageDropdown, #profileDropdown {
            transition: all 0.2s ease-in-out;
            transform-origin: top right;
        }

        #notificationDropdown:not(.hidden),
        #messageDropdown:not(.hidden),
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
    </style>
</body>
</html>
