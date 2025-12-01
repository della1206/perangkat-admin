@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">

<h2 class="text-xl font-bold mb-3">Tambah Perangkat Desa</h2>

<form method="POST" action="{{ route('perangkat_desa.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Warga ID</label>
    <input type="text" name="warga_id" class="border p-2 w-full mb-3">

    <label>Jabatan</label>
    <input type="text" name="jabatan" class="border p-2 w-full mb-3">

    <label>NIP</label>
    <input type="text" name="nip" class="border p-2 w-full mb-3">

    <label>Kontak</label>
    <input type="text" name="kontak" class="border p-2 w-full mb-3">

    <label>Periode Mulai</label>
    <input type="date" name="periode_mulai" class="border p-2 w-full mb-3">

    <label>Periode Selesai</label>
    <input type="date" name="periode_selesai" class="border p-2 w-full mb-3">

    <label>Upload Foto (Multiple)</label>
    <input type="file" name="files[]" multiple class="border p-2 w-full mb-3">

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

</div>
@endsection
