@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-4">Tambah Lembaga Desa</h1>

    <form action="{{ route('lembaga.store') }}" method="POST">
        @csrf

        <label class="block font-semibold">Nama Lembaga</label>
        <input type="text" name="nama_lembaga" class="w-full border rounded p-2 mb-4">

        <label class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border rounded p-2 mb-4" rows="4"></textarea>

        <label class="block font-semibold">Kontak</label>
        <input type="text" name="kontak" class="w-full border rounded p-2 mb-4">

        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
