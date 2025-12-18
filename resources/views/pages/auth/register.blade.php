<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Desa</title>
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

        /* Registration form dengan sedikit blur */
        .register-form {
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

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background-color: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="main-container max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

        <!-- Left Side - Benefits -->
        <div class="text-center lg:text-left welcome-section hover-lift">
            <!-- Logo -->
            <div class="flex justify-center lg:justify-start mb-8">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Desa" 
                             class="w-12 h-12 rounded-xl">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 text-contrast">Desa Digital</h1>
                        <p class="text-sm text-gray-600 text-contrast">Admin System</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4 text-contrast">
                    Bergabung dengan Kami
                </h1>
                <p class="text-xl text-gray-600 mb-6 text-contrast">
                    Daftarkan akun untuk mulai mengelola data desa secara digital
                </p>
            </div>

            <!-- Benefits -->
            <div class="space-y-6">
                <div class="flex items-start space-x-4 solid-bg p-4 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shield-alt text-blue-500 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Akses Aman</h3>
                        <p class="text-gray-600">Data desa terlindungi dengan sistem keamanan terbaik</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 solid-bg p-4 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-chart-line text-green-500 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Monitoring Real-time</h3>
                        <p class="text-gray-600">Pantau perkembangan desa secara langsung dan real-time</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 solid-bg p-4 rounded-lg shadow-sm">
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
        <div class="register-form p-8 lg:p-10 shadow-xl hover-lift">
            <!-- Logo di Form -->
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
                <p class="text-gray-600">Isi data diri Anda untuk registrasi</p>
            </div>

            <!-- Session Messages -->
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center solid-bg">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center solid-bg">
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
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="masukkan nama lengkap"
                            required
                        >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
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
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="masukkan email Anda"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Peran (Role)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <select
                            name="role"
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field appearance-none"
                            required
                        >
                            <option value="" disabled selected>Pilih peran Anda</option>
                            <option value="Super admin" {{ old('role') == 'Super admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    @error('role')
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
                        <input
                            type="password"
                            name="password"
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="buat password yang kuat"
                            required
                        >
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                    @enderror
                    
                    <div class="mt-2">
                        <p class="text-xs text-gray-500 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Password minimal 8 karakter dengan kombinasi huruf dan angka
                        </p>
                    </div>
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
                            class="w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 input-field"
                            placeholder="ulangi password Anda"
                            required
                        >
                    </div>
                </div>

                <!-- Terms Agreement -->
                <div class="flex items-start space-x-3 solid-bg p-4 rounded-lg">
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
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg font-semibold hover:from-green-600 hover:to-green-700 focus:ring-4 focus:ring-green-200 transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-8 pt-6 border-t border-gray-100">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:text-blue-600 ml-1 transition duration-200">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Menambahkan efek interaktif sederhana
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-blue-200');
                });
                input.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-blue-200');
                });
            });
        });
    </script>
</body>
</html>