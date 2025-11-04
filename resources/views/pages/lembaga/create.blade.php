@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Tambah Data Lembaga Desa</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lembaga.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Lembaga</label>
                <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga') }}" required
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Ketua</label>
                <input type="text" name="ketua" value="{{ old('ketua') }}" required
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Bidang</label>
                <input type="text" name="bidang" value="{{ old('bidang') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">{{ old('deskripsi') }}</textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('lembaga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
