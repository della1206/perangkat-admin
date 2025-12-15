<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

        <!-- Left Side - Welcome Section -->
        <div class="text-center lg:text-left">
            <!-- Ganti bagian logo dengan gambar -->
            <div class="flex justify-center lg:justify-start mb-8">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logodesa.png') }}" alt="Logo Desa" class="w-12 h-12 rounded-xl shadow-lg">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Desa Digital</h1>
                        <p class="text-sm text-gray-600">Admin System</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                    Sistem Perangkat Desa
                </h1>
                <p class="text-xl text-gray-600 mb-6">
                    Permudah pengelolaan data warga dan lembaga desa secara digital
                </p>
                <div class="flex items-center justify-center lg:justify-start space-x-4 text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        <span>Data Warga</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-building text-green-500 mr-2"></i>
                        <span>Lembaga Desa</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar text-purple-500 mr-2"></i>
                        <span>Laporan</span>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="space-y-4 mt-12">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-blue-500 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Kelola data warga dengan mudah</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Pantau lembaga desa terintegrasi</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-purple-500 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Akses real-time dan aman</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10">
            <!-- Logo di Form -->
            <div class="text-center mb-2">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                           <img src="{{ asset('assets/img/logodesa.png') }}" alt="Logo Desa" class="w-12 h-12 rounded-xl shadow-lg">
                        <i class="fas fa-village text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang </h2>
                <p class="text-gray-600">Silahkan login terlebih dahulu!</p>
            </div>

            <!-- Session Messages -->
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="masukkan email Anda" required>
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
                        <input type="password" name="password"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="masukkan password Anda" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-8 pt-6 border-t border-gray-200">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-500 font-semibold hover:text-blue-600 ml-1">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</body>

</html>
