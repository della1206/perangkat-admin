@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-1">Tambah Jabatan Lembaga</h1>
    <p class="text-gray-500 mb-6">Form untuk menambahkan jabatan lembaga desa</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('jabatan-lembaga.store') }}" method="POST">
            @csrf

            {{-- Lembaga --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nama Lembaga</label>
                <select name="lembaga_id"
                        class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                        required>
                    <option value="" hidden>Pilih Lembaga</option>
                    @foreach ($lembaga as $item)
                        <option value="{{ $item->lembaga_id }}">{{ $item->nama_lembaga }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Jabatan --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nama Jabatan</label>
                <input type="text" name="nama_jabatan"
                       class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                       required>
            </div>

            {{-- Level --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Level Jabatan</label>
                <input type="number" name="level"
                       class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                       required>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('jabatan-lembaga.index') }}"
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Batal
                </a>

                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
