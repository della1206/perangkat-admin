@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Data Lembaga Desa</h1>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lembaga.update', ['lembaga' => $lembaga->lembaga_id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Ketua</label>
            <input type="text" name="ketua" value="{{ old('ketua', $lembaga->ketua) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Bidang</label>
            <input type="text" name="bidang" value="{{ old('bidang', $lembaga->bidang) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $lembaga->kontak) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('lembaga.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Kembali
            </a>
            <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
