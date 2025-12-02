@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">

    <h1 class="text-xl font-bold mb-4">Detail Lembaga Desa</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="flex justify-center">
            @php $logo = $lembaga->media->first(); @endphp

            @if ($logo)
                <img src="{{ asset('uploads/'.$logo->file_name) }}"
                     class="w-40 h-40 object-cover border rounded">
            @else
                <div class="w-40 h-40 border rounded flex justify-center items-center text-gray-500">
                    Tidak ada media
                </div>
            @endif
        </div>

        <div class="md:col-span-2 space-y-4">
            <div>
                <h3 class="text-sm text-gray-500">Nama Lembaga</h3>
                <p class="text-lg font-semibold">{{ $lembaga->nama_lembaga }}</p>
            </div>

            <div>
                <h3 class="text-sm text-gray-500">Deskripsi</h3>
                <p class="text-gray-700">{{ $lembaga->deskripsi }}</p>
            </div>

            <div>
                <h3 class="text-sm text-gray-500">Kontak</h3>
                <p class="text-gray-700">{{ $lembaga->kontak ?? '-' }}</p>
            </div>
        </div>
    </div>

    <h3 class="text-lg font-semibold mt-6 mb-2">Semua Media</h3>
    <div class="flex gap-3 flex-wrap">
        @foreach ($lembaga->media as $img)
            <img src="{{ asset('uploads/'.$img->file_name) }}" class="w-24 h-24 object-cover border rounded">
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('lembaga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>

</div>
@endsection
