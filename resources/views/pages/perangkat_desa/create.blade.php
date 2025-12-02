@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Tambah Perangkat Desa</h1>

    <form action="{{ route('perangkat_desa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Jabatan</label>
            <input type="text" name="jabatan" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kontak</label>
            <input type="text" name="kontak" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Foto</label>
            <input type="file" name="media[]" class="w-full border p-2 rounded" accept="image/*">
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>

        <a href="{{ route('perangkat_desa.index') }}" class="ml-3 text-gray-600">Batal</a>
    </form>

</div>
@endsection
