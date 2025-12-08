@extends('layouts.admin.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Perangkat Desa</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Foto --}}
        <div class="md:col-span-1">
            <div class="bg-gray-50 p-4 rounded-lg">
                @if($perangkat->foto)
                    <img src="{{ Storage::url($perangkat->foto) }}" 
                         alt="Foto {{ $perangkat->warga->nama }}" 
                         class="w-full h-auto rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>
        </div>

        {{-- Data --}}
        <div class="md:col-span-2">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-lg font-semibold">{{ $perangkat->warga->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. KTP</label>
                        <p class="mt-1">{{ $perangkat->warga->no_ktp }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Jabatan</label>
                        <p class="mt-1">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $perangkat->jabatan }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">NIP</label>
                        <p class="mt-1">{{ $perangkat->nip ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kontak</label>
                        <p class="mt-1">{{ $perangkat->kontak }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Periode Jabatan</label>
                        <p class="mt-1">
                            {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d F Y') }}
                            @if($perangkat->periode_selesai)
                                - {{ \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d F Y') }}
                            @else
                                - Sekarang
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Info Warga --}}
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Warga</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1">{{ $perangkat->warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Agama</label>
                            <p class="mt-1">{{ $perangkat->warga->agama }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                            <p class="mt-1">{{ $perangkat->warga->pekerjaan }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1">{{ $perangkat->warga->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol --}}
    <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('perangkat-desa.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
            Kembali
        </a>
        <a href="{{ route('perangkat-desa.edit', $perangkat->perangkat_id) }}" 
           class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Edit
        </a>
    </div>
</div>
@endsection