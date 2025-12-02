@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Edit Perangkat Desa</h1>

    <form action="{{ route('perangkat_desa.update', $data->perangkat_id) }}" 
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block mb-1">Jabatan</label>
            <input type="text" name="jabatan" class="w-full border p-2 rounded"
                   value="{{ $data->jabatan }}" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kontak</label>
            <input type="text" name="kontak" class="w-full border p-2 rounded"
                   value="{{ $data->kontak }}">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Foto Lama</label>

            @if ($data->media->count() > 0)
                <img src="{{ asset('uploads/perangkat_desa/'.$data->media->first()->file_name) }}"
                     class="w-24 h-24 object-cover rounded mb-2">
            @else
                <p class="text-gray-500">Tidak ada foto</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="block mb-1">Upload Foto Baru</label>
            <input type="file" name="media[]" class="w-full border p-2 rounded" accept="image/*">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        <a href="{{ route('perangkat_desa.index') }}" class="ml-3 text-gray-600">Batal</a>

    </form>

</div>
@endsection
