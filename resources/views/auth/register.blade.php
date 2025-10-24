<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Registrasi Akun</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Username</label>
                <input type="text" name="username" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" placeholder="" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login di sini</a>
        </p>

        <p class="text-center text-xs text-gray-400 mt-2">
    
        </p>
    </div>
</body>
</html>
