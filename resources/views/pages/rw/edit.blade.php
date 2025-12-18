@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">Edit Data RW</h1>
    <p class="text-gray-500 mb-6">Form untuk mengubah data Rukun Warga (RW)</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('rw.update', $rw->rw_id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nomor RW --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nomor RW <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_rw" value="{{ old('nomor_rw', $rw->nomor_rw) }}"
                       class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                       required>
                @error('nomor_rw')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ketua RW --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Ketua RW</label>
                <select name="ketua_rw_warga_id"
                        class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200">
                    <option value="">Pilih Ketua RW</option>
                    @foreach ($warga as $w)
                        <option value="{{ $w->warga_id }}" 
                                {{ (old('ketua_rw_warga_id', $rw->ketua_rw_warga_id) == $w->warga_id) ? 'selected' : '' }}>
                            {{ $w->nama }} - {{ $w->no_ktp }}
                        </option>
                    @endforeach
                </select>
                @error('ketua_rw_warga_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3"
                          class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200">{{ old('keterangan', $rw->keterangan) }}</textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('rw.index') }}"
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection