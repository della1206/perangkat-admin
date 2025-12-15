<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-image: url('{{ asset("assets/img/perangkat1.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* Overlay yang sangat transparan agar gambar benar-benar kelihatan */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.3) 0%, 
                rgba(255, 255, 255, 0.2) 50%,
                rgba(255, 255, 255, 0.15) 100%);
            z-index: 1;
            pointer-events: none;
        }

        /* Efek brightness untuk gambar lebih cerah */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
            pointer-events: none;
        }

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
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                        0 10px 10px -5px rgba(0, 0, 0, 0.08);
        }

        /* Kontainer utama dengan z-index lebih tinggi */
        .main-container {
            position: relative;
            z-index: 10;
        }

        /* Welcome section dengan background lebih transparan */
        .welcome-section {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(2px);
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        /* Login form dengan sedikit blur */
        .login-form {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(2px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Text dengan kontras lebih baik */
        .text-contrast {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Elemen dengan latar lebih solid */
        .solid-bg {
            background: rgba(255, 255, 255, 0.95);
        }

        /* Input fields yang lebih terlihat */
        .input-field {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(209, 213, 219, 0.8);
        }

        /* Hover effect untuk card */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 35px -5px rgba(0, 0, 0, 0.15),
                        0 15px 15px -5px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="flex items-center justify-center p-4">
    <div class="main-container max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

        <!-- Left Side - Welcome Section -->
        <div class="text-center lg:text-left welcome-section hover-lift">
            <!-- Logo -->
            <div class="flex justify-center lg:justify-start mb-8">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logodesa.png') }}" alt="Logo Desa" 
                         class="w-12 h-12 rounded-xl shadow-lg">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 text-contrast">Desa Digital</h1>
                        <p class="text-sm text-gray-600 text-contrast">Admin System</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4 text-contrast">
                    Sistem Perangkat Desa
                </h1>
                <p class="text-xl text-gray-600 mb-6 text-contrast">
                    Permudah pengelolaan data warga dan lembaga desa secara digital
                </p>
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3">
                    <div class="flex items-center solid-bg px-4 py-2 rounded-lg shadow-sm">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        <span class="font-medium">Data Warga</span>
                    </div>
                    <div class="flex items-center solid-bg px-4 py-2 rounded-lg shadow-sm">
                        <i class="fas fa-building text-green-500 mr-2"></i>
                        <span class="font-medium">Lembaga Desa</span>
                    </div>
                    <div class="flex items-center solid-bg px-4 py-2 rounded-lg shadow-sm">
                        <i class="fas fa-chart-bar text-purple-500 mr-2"></i>
                        <span class="font-medium">Laporan</span>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="space-y-4 mt-12">
                <div class="flex items-center space-x-3 solid-bg p-4 rounded-lg shadow-sm">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-check text-blue-500"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Kelola data warga dengan mudah</span>
                </div>
                <div class="flex items-center space-x-3 solid-bg p-4 rounded-lg shadow-sm">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-check text-green-500"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Pantau lembaga desa terintegrasi</span>
                </div>
                <div class="flex items-center space-x-3 solid-bg p-4 rounded-lg shadow-sm">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-check text-purple-500"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Akses real-time dan aman</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-form p-8 lg:p-10 shadow-xl hover-lift">
            <!-- Logo di Form -->
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/img/logodesa.png') }}" alt="Logo Desa" 
                             class="w-14 h-14 rounded-lg">
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
                <p class="text-gray-600">Silahkan login terlebih dahulu!</p>
            </div>

            <!-- Session Messages -->
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center solid-bg">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center solid-bg">
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
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="masukkan email Anda" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
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
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="masukkan password Anda" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium transition duration-200">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-8 pt-6 border-t border-gray-100">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" 
                       class="text-blue-500 font-semibold hover:text-blue-600 ml-1 transition duration-200">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Menambahkan efek interaktif sederhana
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-200');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-200');
                });
            });
        });
    </script>
</body>

</html>