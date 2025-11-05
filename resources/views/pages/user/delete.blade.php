@extends('layouts.admin.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data User</h2>

    <form action="{{ route('user.update', $user->user_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
            </div> -->

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password (opsional)</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('user.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>

    <!-- Form Hapus -->
    <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
            Hapus User
        </button>
    </form>
</div>
@endsection
