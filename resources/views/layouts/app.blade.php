<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Bina Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @include('layouts.admin.css')
</head>

<body class="bg-gray-100 flex h-screen">
    @include('layouts.admin.sidebar')

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        @include('layouts.admin.header')

        <!-- Isi konten halaman -->
        <main class="p-8 bg-gray-100 flex-1">
            @yield('content')
        </main>

        @include('layouts.admin.footer')
    </div>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Aplikasi%20Bina%20Desa."
           target="_blank"
           class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center hover:bg-green-600 transition duration-300 transform hover:scale-110 block animate-bounce">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>

        <!-- Tooltip -->
        <div class="absolute bottom-16 right-0 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 transition-opacity duration-300 pointer-events-none"
             id="whatsappTooltip">
            Hubungi Admin Desa
        </div>
    </div>

    @include('layouts.admin.js')
</body>
</html>