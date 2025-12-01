@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Lembaga Desa</h1>

    <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" 
                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nama_lembaga')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4" 
                      class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <label class="block font-semibold">Nama Lembaga</label>
        <input type="text" name="nama_lembaga" value="{{ $lembaga->nama_lembaga }}" class="w-full border rounded p-2 mb-4" required>

        {{-- HAPUS FIELD KETUA --}}

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $lembaga->kontak) }}" 
                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('kontak')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
            <a href="{{ route('lembaga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Batal
            </a>
        </div>
        <label class="block font-semibold">Kontak</label>
        <input type="text" name="kontak" value="{{ $lembaga->kontak }}" class="w-full border rounded p-2 mb-4">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection