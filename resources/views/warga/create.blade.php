@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Warga</h2>

    <form action="{{ route('warga.create') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nama Warga</label>
            <input type="text" name="nama" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">NIK</label>
            <input type="text" name="nik" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Alamat</label>
            <input type="text" name="alamat" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Simpan
        </button>
    </form>
</div>
@endsection
