<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-lg text-center w-96">
        <h2 class="text-2xl font-bold text-green-600 mb-4">Login Berhasil</h2>

        <p class="text-gray-700 mb-2">
            Selamat datang, <span class="font-semibold">{{ session('username') }}</span>!
        </p>

        <p class="text-gray-600 mb-6">
            email: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ session('email') }}</span>
        </p>

        <p class="text-gray-600 mb-6">
            Password: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ session('password') }}</span>
        </p>

        <div class="mt-4">
            <a href="{{ route('dashboard.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Lanjut ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
