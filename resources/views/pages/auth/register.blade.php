<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

        <!-- Left Side - Benefits -->
        <div class="text-center lg:text-left">
            <!-- Logo -->
            <div class="flex justify-center lg:justify-start mb-8">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-village text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Desa Digital</h1>
                        <p class="text-sm text-gray-600">Admin System</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                    Bergabung dengan Kami
                </h1>
                <p class="text-xl text-gray-600 mb-6">
                    Daftarkan akun admin untuk mulai mengelola data desa secara digital
                </p>
            </div>

            <!-- Benefits -->
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shield-alt text-blue-500 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Akses Aman</h3>
                        <p class="text-gray-600">Data desa terlindungi dengan sistem keamanan terbaik</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-chart-line text-green-500 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Monitoring Real-time</h3>
                        <p class="text-gray-600">Pantau perkembangan desa secara langsung dan real-time</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users-cog text-purple-500 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Kelola Mudah</h3>
                        <p class="text-gray-600">Antarmuka yang intuitif untuk pengelolaan data yang efisien</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10">
            <!-- Logo di Form -->
            <div class="text-center mb-2">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
                <p class="text-gray-600">Isi data diri Anda untuk registrasi</p>
            </div>

            <!-- Session Messages -->
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.process') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="masukkan nama lengkap"
                            required
                        >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="masukkan email Anda"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input
                            type="password"
                            name="password"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="buat password yang kuat"
                            required
                        >
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="ulangi password Anda"
                            required
                        >
                    </div>
                </div>

                <!-- Terms Agreement -->
                <div class="flex items-start space-x-3">
                    <input
                        type="checkbox"
                        name="terms"
                        class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500 mt-1"
                        required
                    >
                    <label class="text-gray-600 text-sm">
                        Saya menyetujui <a href="#" class="text-blue-500 hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-500 hover:underline">Kebijakan Privasi</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg font-semibold hover:from-green-600 hover:to-green-700 focus:ring-4 focus:ring-green-200 transition duration-200 flex items-center justify-center"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-8 pt-6 border-t border-gray-200">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:text-blue-600 ml-1">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</body>
</html>
