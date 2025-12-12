@extends('layouts.admin.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Lembaga Desa</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            {{-- Nama Lembaga --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Nama Lembaga</label>
                <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Ketua --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Ketua</label>
                <input type="text" name="ketua" value="{{ old('ketua', $lembaga->ketua) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-200">
            </div>

            {{-- Logo --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Logo Lembaga</label>
                @if($lembaga->logo)
                    <div class="mb-3">
                        <img src="{{ Storage::url($lembaga->logo) }}" 
                             alt="Logo {{ $lembaga->nama_lembaga }}" 
                             class="w-32 h-32 object-contain border rounded-lg">
                    </div>
                @endif
                <input type="file" name="logo" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-200"
                       accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah logo</p>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-200">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
            </div>

            {{-- Kontak --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak', $lembaga->kontak) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-200">
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('lembaga.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection