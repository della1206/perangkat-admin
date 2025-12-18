@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        {{-- Header dengan Breadcrumb --}}
        <div class="mb-6">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('lembaga.index') }}" 
                           class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Lembaga Desa
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Lembaga</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $lembaga->nama_lembaga }}</h1>
                    <p class="text-gray-600 mt-1">Detail informasi lembaga desa</p>
                </div>
                <a href="{{ route('lembaga.index') }}" 
                   class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Card Utama --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Header dengan Logo --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-8">
                <div class="flex flex-col md:flex-row items-center">
                    @if($lembaga->logo)
                        <div class="mb-6 md:mb-0 md:mr-8">
                            <div class="w-32 h-32 bg-white rounded-full p-2 shadow-lg">
                                <img src="{{ Storage::url($lembaga->logo) }}" 
                                     alt="Logo {{ $lembaga->nama_lembaga }}" 
                                     class="w-full h-full object-contain">
                            </div>
                        </div>
                    @endif
                    <div class="text-white text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-2">{{ $lembaga->nama_lembaga }}</h2>
                        @if($lembaga->ketua)
                            <div class="flex items-center justify-center md:justify-start mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-lg">Ketua: {{ $lembaga->ketua }}</span>
                            </div>
                        @endif
                        @if($lembaga->kontak)
                            <div class="flex items-center justify-center md:justify-start">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-lg">{{ $lembaga->kontak }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Konten Detail --}}
            <div class="p-8">
                {{-- Deskripsi --}}
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Deskripsi Lembaga</h3>
                    <div class="prose max-w-none">
                        @if($lembaga->deskripsi)
                            <p class="text-gray-700 leading-relaxed">{{ $lembaga->deskripsi }}</p>
                        @else
                            <p class="text-gray-500 italic">Belum ada deskripsi untuk lembaga ini.</p>
                        @endif
                    </div>
                </div>

                {{-- Informasi Lembaga --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Kepengurusan
                        </h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ketua:</span>
                                <span class="font-medium">{{ $lembaga->ketua ?: '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kontak:</span>
                                <span class="font-medium">{{ $lembaga->kontak ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Sistem
                        </h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID Lembaga:</span>
                                <span class="font-medium text-gray-900">{{ $lembaga->lembaga_id }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Dibuat:</span>
                                <span class="font-medium">
                                    {{ optional($lembaga->created_at)->format('d-m-Y') ?: 'Belum tersedia' }}
                                </span>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Terakhir Diperbarui:</span>
                                <span class="font-medium">
                                    {{ optional($lembaga->updated_at)->format('d-m-Y') ?: 'Belum tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer dengan Tombol Aksi --}}
            <div class="px-8 py-6 bg-gray-50 border-t">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-500 mb-4 md:mb-0">
                        Terakhir diperbarui: 
                         @if($lembaga->updated_at)
                        {{ $lembaga->updated_at->format('d F Y H:i') }}
                         @else
                            Data belum pernah diperbarui
                        @endif
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Lembaga
                        </a>
                        <a href="{{ route('lembaga.index') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg flex items-center transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .prose {
        color: #374151;
        line-height: 1.75;
    }
    .prose p {
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }
</style>
@endsection