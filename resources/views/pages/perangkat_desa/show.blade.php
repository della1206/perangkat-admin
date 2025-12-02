@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Detail Perangkat Desa</h1>

    <div class="mb-4">
        <strong>Jabatan:</strong> {{ $data->jabatan }}
    </div>

    <div class="mb-4">
        <strong>Kontak:</strong> {{ $data->kontak }}
    </div>

    <div class="mb-4">
        <strong>Foto:</strong><br>

        @if ($data->media->count() > 0)
            <img src="{{ asset('uploads/perangkat_desa/'.$data->media->first()->file_name) }}"
                 class="w-32 h-32 object-cover rounded">
        @else
            <p class="text-gray-500">Tidak ada foto</p>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('perangkat_desa.edit', $data->perangkat_id) }}" class="text-blue-600 font-semibold">
            Edit
        </a> |

        <a href="{{ route('perangkat_desa.index') }}" class="text-gray-600">Kembali</a>
    </div>

</div>
@endsection
