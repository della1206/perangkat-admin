@extends('layouts.admin.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Tambah Data User</h2>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah user --}}
    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            {{-- Nama --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Role</label>
                <select name="role" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Pilih Role</option>
                    <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('user.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Kembali
            </a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection