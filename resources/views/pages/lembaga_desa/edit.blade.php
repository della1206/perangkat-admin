@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">

    <h1 class="text-xl font-bold mb-4">Edit Lembaga</h1>

    <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Nama Lembaga</label>
        <input type="text" name="nama_lembaga" value="{{ $lembaga->nama_lembaga }}" class="w-full border p-2 mb-3">

        <label>Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 mb-3">{{ $lembaga->deskripsi }}</textarea>

        <label>Kontak</label>
        <input type="text" name="kontak" value="{{ $lembaga->kontak }}" class="w-full border p-2 mb-3">

        <label>Logo Saat Ini:</label>
        <div class="flex gap-3 flex-wrap mb-3">
            @foreach ($lembaga->media as $img)
                <img src="{{ asset('uploads/'.$img->file_name) }}" class="w-20 h-20 object-cover rounded border">
            @endforeach
        </div>

        <label>Upload Logo Baru (Hanya 1 File)</label>
        <input type="file" name="media[]" class="w-full border p-2 mb-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>

    <h3 class="font-semibold mb-2 mt-6">Media Saat Ini:</h3>

    <div class="flex gap-4">
        @foreach ($lembaga->media as $m)
            <div class="text-center">
                <img src="{{ asset('uploads/' . $m->file_name) }}"
                    class="w-24 h-24 object-cover border rounded shadow mb-1">

                <form action="{{ route('media.destroy', $m->media_id) }}" method="POST"
                        onsubmit="return confirm('Hapus media ini?')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-2 py-1 text-sm rounded">
                        Hapus
                    </button>
                </form>
            </div>
        @endforeach
    </div>

</div>
@endsection
