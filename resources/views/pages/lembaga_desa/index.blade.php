@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Data Lembaga Desa</h1>
            <p class="text-gray-500">Kelola lembaga-lembaga di desa</p>
        </div>

        <a href="{{ route('lembaga.create') }}"
           class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Lembaga
        </a>
    </div>

    {{-- FILTER DAN SEARCH --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('lembaga.index') }}" class="flex flex-col md:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama lembaga, ketua, atau kontak..." 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-10 focus:ring-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Sort --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                <div class="flex gap-2">
                    <select name="sort" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="nama_lembaga" {{ request('sort', 'nama_lembaga') == 'nama_lembaga' ? 'selected' : '' }}>Nama Lembaga</option>
                        <option value="ketua" {{ request('sort') == 'ketua' ? 'selected' : '' }}>Ketua</option>
                        <option value="kontak" {{ request('sort') == 'kontak' ? 'selected' : '' }}>Kontak</option>
                    </select>
                    
                    <select name="order" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="asc" {{ request('order', 'asc') == 'asc' ? 'selected' : '' }}>A-Z</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z-A</option>
                    </select>
                </div>
            </div>

            {{-- Opsi Items per Page --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Per Halaman</label>
                <select name="per_page" 
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>

            {{-- Tombol Action --}}
            <div class="flex items-end gap-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg h-[42px] flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Terapkan
                </button>
                
                @if(request()->hasAny(['search', 'sort', 'order', 'per_page']))
                <a href="{{ route('lembaga.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg h-[42px] flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($lembaga->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border text-left text-sm font-medium text-gray-700">No</th>
                        <th class="py-3 px-4 border text-left text-sm font-medium text-gray-700">Nama</th>
                        <th class="py-3 px-4 border text-left text-sm font-medium text-gray-700">Ketua</th>
                        <th class="py-3 px-4 border text-left text-sm font-medium text-gray-700">Kontak</th>
                        <th class="py-3 px-4 border text-center text-sm font-medium text-gray-700 w-40">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($lembaga as $item)
                        <tr class="hover:bg-gray-50">
                            {{-- Nomor dengan pagination offset --}}
                            <td class="py-3 px-4 border text-center">
                                {{ ($lembaga->currentPage() - 1) * $lembaga->perPage() + $loop->iteration }}
                            </td>
                            
                            <td class="py-3 px-4 border">
                                <div class="flex items-center">
                                    @if($item->logo)
                                        <img src="{{ Storage::url($item->logo) }}" 
                                             alt="{{ $item->nama_lembaga }}" 
                                             class="w-10 h-10 rounded-full object-cover mr-3">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <span class="text-blue-600 font-bold">{{ substr($item->nama_lembaga, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $item->nama_lembaga }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-xs">
                                            {{ Str::limit($item->deskripsi, 50) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-3 px-4 border">
                                @if($item->ketua)
                                    <div class="font-medium">{{ $item->ketua }}</div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            
                            <td class="py-3 px-4 border">
                                @if($item->kontak)
                                    <div class="text-sm">{{ $item->kontak }}</div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            <td class="py-3 px-4 border">
                                <div class="flex justify-center space-x-2">
                                    {{-- TOMBOL DETAIL --}}
                                    <a href="{{ route('lembaga.show', $item->lembaga_id) }}"
                                       class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-2 rounded-lg transition"
                                       title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>

                                    {{-- TOMBOL EDIT --}}
                                    <a href="{{ route('lembaga.edit', $item->lembaga_id) }}"
                                       class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 p-2 rounded-lg transition"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST" 
                                          class="inline-block" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-800 p-2 rounded-lg transition"
                                                title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($lembaga->hasPages())
        <div class="px-4 py-3 border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between">
                {{-- Info jumlah data --}}
                <div class="mb-3 md:mb-0 text-sm text-gray-700">
                    Menampilkan 
                    <span class="font-medium">{{ $lembaga->firstItem() }}</span> 
                    sampai 
                    <span class="font-medium">{{ $lembaga->lastItem() }}</span> 
                    dari 
                    <span class="font-medium">{{ $lembaga->total() }}</span> 
                    lembaga
                </div>
                
                {{-- Navigasi halaman --}}
                <div class="flex items-center space-x-1">
                    {{-- Previous Page Link --}}
                    @if($lembaga->onFirstPage())
                        <span class="px-3 py-2 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $lembaga->previousPageUrl() }}{{ request()->hasAny(['search', 'sort', 'order', 'per_page']) ? '&' . http_build_query(request()->only(['search', 'sort', 'order', 'per_page'])) : '' }}"
                           class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $current = $lembaga->currentPage();
                        $last = $lembaga->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $current + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $lembaga->url(1) }}{{ request()->hasAny(['search', 'sort', 'order', 'per_page']) ? '&' . http_build_query(request()->only(['search', 'sort', 'order', 'per_page'])) : '' }}"
                           class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">1</a>
                        @if($start > 2) <span class="px-2 text-gray-500">...</span> @endif
                    @endif

                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $current)
                            <span class="px-3 py-2 border border-gray-300 rounded bg-blue-600 text-white font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $lembaga->url($page) }}{{ request()->hasAny(['search', 'sort', 'order', 'per_page']) ? '&' . http_build_query(request()->only(['search', 'sort', 'order', 'per_page'])) : '' }}"
                               class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if($end < $last)
                        @if($end < $last - 1) <span class="px-2 text-gray-500">...</span> @endif
                        <a href="{{ $lembaga->url($last) }}{{ request()->hasAny(['search', 'sort', 'order', 'per_page']) ? '&' . http_build_query(request()->only(['search', 'sort', 'order', 'per_page'])) : '' }}"
                           class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">{{ $last }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($lembaga->hasMorePages())
                        <a href="{{ $lembaga->nextPageUrl() }}{{ request()->hasAny(['search', 'sort', 'order', 'per_page']) ? '&' . http_build_query(request()->only(['search', 'sort', 'order', 'per_page'])) : '' }}"
                           class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-3 py-2 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        @else
        {{-- EMPTY STATE --}}
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada data lembaga</h3>
            <p class="mt-1 text-gray-500">
                @if(request()->hasAny(['search', 'sort', 'order']))
                    Coba ubah filter pencarian Anda
                @else
                    <a href="{{ route('lembaga.create') }}" class="text-blue-600 hover:underline">
                        Tambah lembaga
                    </a> untuk memulai
                @endif
            </p>
        </div>
        @endif
    </div>
</div>
@endsection