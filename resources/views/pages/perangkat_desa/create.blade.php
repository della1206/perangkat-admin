@extends('layouts.admin.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Perangkat Desa</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perangkat-desa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Warga --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Pilih Warga</label>
                <select name="warga_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Pilih Warga</option>
                    @foreach($warga as $w)
                        <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                            {{ $w->nama }} ({{ $w->no_ktp }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" 
                       placeholder="Contoh: Kepala Desa" required>
            </div>

            {{-- NIP --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">NIP (Opsional)</label>
                <input type="text" name="nip" value="{{ old('nip') }}" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" 
                       placeholder="Nomor Induk Pegawai">
            </div>

            {{-- Kontak --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" 
                       placeholder="08xxxxxxxxxx" required>
            </div>

            {{-- Foto --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Foto</label>
                <input type="file" name="foto" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Maksimal 2MB (jpg, jpeg, png)</p>
            </div>

            {{-- Periode Mulai --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Periode Mulai</label>
                <input type="date" name="periode_mulai" value="{{ old('periode_mulai') }}" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Periode Selesai --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Periode Selesai (Opsional)</label>
                <input type="date" name="periode_selesai" value="{{ old('periode_selesai') }}" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika masih menjabat</p>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('perangkat-desa.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection