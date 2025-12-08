@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
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

                {{-- Multiple Foto --}}
                @if($lembaga->foto && count($lembaga->foto) > 0)
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Galeri Foto</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($lembaga->foto as $index => $foto)
                                <div class="relative group overflow-hidden rounded-lg shadow-md">
                                    <img src="{{ Storage::url($foto) }}" 
                                         alt="Foto {{ $index + 1 }}" 
                                         class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-opacity duration-300 flex items-center justify-center">
                                        <button onclick="openModal('{{ Storage::url($foto) }}')"
                                                class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 bg-white text-gray-800 px-4 py-2 rounded-lg font-medium">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500 mt-3">Total {{ count($lembaga->foto) }} foto</p>
                    </div>
                @else
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Galeri Foto</h3>
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="mt-4 text-gray-500">Belum ada foto untuk lembaga ini</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Footer dengan Tombol Aksi --}}
            <div class="px-8 py-6 bg-gray-50 border-t">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        ID Lembaga: {{ $lembaga->lembaga_id }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
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

{{-- Modal untuk foto besar --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeModal()"
                class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="w-full h-auto rounded-lg shadow-2xl">
    </div>
</div>

<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.getElementById('imageModal').classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Close modal when clicking outside image
    document.getElementById('imageModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>

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