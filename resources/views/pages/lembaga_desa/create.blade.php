@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">

    <h1 class="text-xl font-bold mb-4">Tambah Lembaga</h1>

    <form action="{{ route('lembaga.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama Lembaga</label>
        <input type="text" name="nama_lembaga" class="w-full border p-2 mb-3">

        <label>Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 mb-3"></textarea>

        <label>Kontak</label>
        <input type="text" name="kontak" class="w-full border p-2 mb-3">

        <label>Upload Media (Multiple)</label>
        <input type="file" name="media[]" multiple class="w-full border p-2 mb-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>

</div>
@endsection
