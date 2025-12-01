@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">

<h2 class="text-xl font-bold mb-3">Edit Perangkat Desa</h2>

<form method="POST" action="{{ route('perangkat_desa.update', $data->perangkat_id) }}" enctype="multipart/form-data">
    @csrf 
    @method('PUT')

    <label>Warga ID</label>
    <input type="text" name="warga_id" class="border p-2 w-full mb-3" value="{{ $data->warga_id }}">

    <label>Jabatan</label>
    <input type="text" name="jabatan" class="border p-2 w-full mb-3" value="{{ $data->jabatan }}">

    <label>NIP</label>
    <input type="text" name="nip" class="border p-2 w-full mb-3" value="{{ $data->nip }}">

    <label>Kontak</label>
    <input type="text" name="kontak" class="border p-2 w-full mb-3" value="{{ $data->kontak }}">

    <label>Periode Mulai</label>
    <input type="date" name="periode_mulai" class="border p-2 w-full mb-3" value="{{ $data->periode_mulai }}">

    <label>Periode Selesai</label>
    <input type="date" name="periode_selesai" class="border p-2 w-full mb-3" value="{{ $data->periode_selesai }}">

    <label>Upload Foto Baru (Multiple)</label>
    <input type="file" name="files[]" multiple class="border p-2 w-full mb-3">

    <h3 class="text-lg font-bold mt-4 mb-2">Foto Saat Ini</h3>

    <div class="grid grid-cols-4 gap-3">
        @foreach ($data->media as $m)
            <div class="border p-2">
                <img src="/uploads/perangkat_desa/{{ $m->file_name }}" class="w-full h-32 object-cover">
                <p class="text-sm mt-1">{{ $m->caption }}</p>
            </div>
        @endforeach
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Update</button>
</form>

</div>
@endsection
