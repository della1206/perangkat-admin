@extends('layouts.admin.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Anggota Lembaga</h1>

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anggota-lembaga.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- LEMBAGA --}}
        <div>
            <label class="block font-medium mb-1">Lembaga</label>
            <select name="lembaga_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Lembaga --</option>
                @foreach($lembagas as $lembaga)
                    <option value="{{ $lembaga->lembaga_id }}" {{ old('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                        {{ $lembaga->nama_lembaga }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- WARGA --}}
        <div>
            <label class="block font-medium mb-1">Nama Warga</label>
            <select name="warga_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($wargas as $warga)
                    <option value="{{ $warga->warga_id }}" {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                        {{ $warga->nama }} - {{ $warga->nik }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- JABATAN --}}
        <div>
            <label class="block font-medium mb-1">Jabatan</label>
            <select name="jabatan_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($jabatans as $jabatan)
                    <option value="{{ $jabatan->jabatan_id }}" {{ old('jabatan_id') == $jabatan->jabatan_id ? 'selected' : '' }}>
                        {{ $jabatan->nama_jabatan }} (Level {{ $jabatan->level }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TANGGAL MULAI --}}
        <div>
            <label class="block font-medium mb-1">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- TANGGAL SELESAI --}}
        <div>
            <label class="block font-medium mb-1">Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
                   class="w-full border rounded px-3 py-2">
            <small class="text-gray-500">Kosongkan jika masih aktif</small>
        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('anggota-lembaga.index') }}"
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Kembali
            </a>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
