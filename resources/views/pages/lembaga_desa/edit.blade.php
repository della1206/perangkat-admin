@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Lembaga Desa</h1>

    <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block font-semibold">Nama Lembaga</label>
        <input type="text" name="nama_lembaga" value="{{ $lembaga->nama_lembaga }}" class="w-full border rounded p-2 mb-4">

         <label class="block text-gray-700">Ketua</label>
        <input type="text" name="ketua" value="{{ $lembaga->ketua }}" class="w-full p-2 border rounded">

        <label class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border rounded p-2 mb-4" rows="4">{{ $lembaga->deskripsi }}</textarea>

        <label class="block font-semibold">Kontak</label>
        <input type="text" name="kontak" value="{{ $lembaga->kontak }}" class="w-full border rounded p-2 mb-4">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
