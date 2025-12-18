@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">Tambah Data RT</h1>
    <p class="text-gray-500 mb-6">Form untuk menambahkan Rukun Tetangga (RT)</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('rt.store') }}" method="POST">
            @csrf

            {{-- RW --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">RW <span class="text-red-500">*</span></label>
                <select name="rw_id"
                        class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                        required>
                    <option value="" hidden>Pilih RW</option>
                    @foreach ($rwList as $rw)
                        <option value="{{ $rw->rw_id }}" {{ old('rw_id') == $rw->rw_id ? 'selected' : '' }}>
                            RW {{ $rw->nomor_rw }}
                            @if($rw->ketuaRw)
                                - Ketua: {{ $rw->ketuaRw->nama }}
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('rw_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor RT --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nomor RT <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_rt" value="{{ old('nomor_rt') }}"
                       placeholder="Contoh: 001"
                       class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200"
                       required>
                @error('nomor_rt')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ketua RT --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Ketua RT</label>
                <select name="ketua_rt_warga_id"
                        class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200">
                    <option value="">Pilih Ketua RT</option>
                    @foreach ($warga as $w)
                        <option value="{{ $w->warga_id }}" {{ old('ketua_rt_warga_id') == $w->warga_id ? 'selected' : '' }}>
                            {{ $w->nama }} - {{ $w->no_ktp }}
                        </option>
                    @endforeach
                </select>
                @error('ketua_rt_warga_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3"
                          placeholder="Keterangan tambahan..."
                          class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-green-200">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('rt.index') }}"
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection