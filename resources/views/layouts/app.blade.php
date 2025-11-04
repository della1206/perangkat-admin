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

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- WhatsApp Button -->
        <button id="whatsappButton" class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center hover:bg-green-600 transition duration-300 transform hover:scale-110">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </button>

        <!-- WhatsApp Options -->
        <div id="whatsappOptions" class="absolute bottom-16 right-0 bg-white rounded-lg shadow-xl p-4 w-64 hidden border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-3 text-sm">Hubungi Kami via WhatsApp</h3>

            <!-- Admin 1 -->
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Aplikasi%20Bina%20Desa."
               target="_blank"
               class="flex items-center space-x-3 p-2 hover:bg-green-50 rounded cursor-pointer mb-2 transition duration-200">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fab fa-whatsapp text-green-500 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Admin Desa</p>
                    <p class="text-xs text-gray-500">+62 812-3456-7890</p>
                </div>
            </a>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-2"></div>

            <!-- Quick Actions -->
            <div class="space-y-2">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20melaporkan%20masalah%20teknis%20pada%20aplikasi."
                   target="_blank"
                   class="block text-xs text-center bg-blue-50 text-blue-600 py-2 px-3 rounded hover:bg-blue-100 transition duration-200">
                    🐛 Laporkan Masalah Teknis
                </a>
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20butuh%20bantuan%20tentang%20cara%20menggunakan%20aplikasi."
                   target="_blank"
                   class="block text-xs text-center bg-purple-50 text-purple-600 py-2 px-3 rounded hover:bg-purple-100 transition duration-200">
                    ❓ Bantuan Penggunaan
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle WhatsApp Options
        const whatsappButton = document.getElementById('whatsappButton');
        const whatsappOptions = document.getElementById('whatsappOptions');

        whatsappButton.addEventListener('click', function(e) {
            e.stopPropagation();
            whatsappOptions.classList.toggle('hidden');
        });

        // Close options when clicking outside
        document.addEventListener('click', function(event) {
            if (!whatsappButton.contains(event.target) && !whatsappOptions.contains(event.target)) {
                whatsappOptions.classList.add('hidden');
            }
        });

        // Prevent options from closing when clicking inside
        whatsappOptions.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Add bounce animation after page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                whatsappButton.classList.add('animate-bounce');
                // Remove bounce after 3 cycles
                setTimeout(() => {
                    whatsappButton.classList.remove('animate-bounce');
                }, 6000);
            }, 1000);
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

        /* Smooth transitions for the dropdown */
        #whatsappOptions {
            transition: all 0.2s ease-in-out;
            transform-origin: bottom right;
        }

        #whatsappOptions:not(.hidden) {
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
