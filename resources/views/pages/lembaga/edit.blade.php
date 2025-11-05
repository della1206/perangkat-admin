@extends('layouts.admin.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Lembaga Desa</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lembaga.update', $lembaga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-1">Nama Lembaga</label>
                <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Ketua</label>
                <input type="text" name="ketua" value="{{ old('ketua', $lembaga->ketua) }}" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Bidang</label>
                <input type="text" name="bidang" value="{{ old('bidang', $lembaga->bidang) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak', $lembaga->kontak) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2 rounded">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('lembaga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
