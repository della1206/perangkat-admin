@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Jabatan Lembaga</h1>
            <p class="text-gray-500">Kelola jabatan dalam lembaga desa</p>
        </div>

        <a href="{{ route('jabatan-lembaga.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Jabatan
        </a>
    </div>

    {{-- FILTER DAN SEARCH --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('jabatan-lembaga.index') }}" class="flex flex-col md:flex-row gap-4">
            {{-- Filter Lembaga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lembaga</label>
                <select name="lembaga_id" 
                        class="w-full md:w-48 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Lembaga</option>
                    @foreach($lembaga as $item)
                        <option value="{{ $item->lembaga_id }}" 
                                {{ request('lembaga_id') == $item->lembaga_id ? 'selected' : '' }}>
                            {{ $item->nama_lembaga }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Level --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <select name="level" 
                        class="w-full md:w-32 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Level</option>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ request('level') == $i ? 'selected' : '' }}>
                            Level {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- Search --}}
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama jabatan atau lembaga..." 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-10 focus:ring-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Tombol Action --}}
            <div class="flex items-end gap-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg h-[42px] flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
                
                @if(request()->hasAny(['search', 'lembaga_id', 'level']))
                <a href="{{ route('jabatan-lembaga.index') }}" 
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
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 border text-center w-12">No</th>
                        <th class="py-3 px-4 border">Nama Lembaga</th>
                        <th class="py-3 px-4 border">Nama Jabatan</th>
                        <th class="py-3 px-4 border text-center w-20">Level</th>
                        <th class="py-3 px-4 border text-center w-28">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jabatan as $item)
                        <tr class="hover:bg-gray-50">
                            {{-- Nomor dengan pagination offset --}}
                            <td class="py-2 px-4 border text-center">
                                {{ ($jabatan->currentPage() - 1) * $jabatan->perPage() + $loop->iteration }}
                            </td>
                            <td class="py-2 px-4 border">
                                <div class="font-medium">{{ $item->lembaga->nama_lembaga ?? '-' }}</div>
                                <div class="text-xs text-gray-500">ID: {{ $item->lembaga_id }}</div>
                            </td>
                            <td class="py-2 px-4 border font-medium">{{ $item->nama_jabatan }}</td>
                            <td class="py-2 px-4 border text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $item->level <= 3 ? 'bg-blue-100 text-blue-800' : 
                                       ($item->level <= 6 ? 'bg-green-100 text-green-800' : 
                                       'bg-purple-100 text-purple-800') }}">
                                    Level {{ $item->level }}
                                </span>
                            </td>

                            <td class="py-2 px-4 border text-center">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}"
                                       class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}"
                                          method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus jabatan ini?')"
                                                class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50"
                                                title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="py-8 px-4 border text-center text-gray-500">
                                @if(request()->hasAny(['search', 'lembaga_id', 'level']))
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Data tidak ditemukan</p>
                                    <p class="text-sm mt-1">Coba ubah filter pencarian Anda</p>
                                @else
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Tidak ada data jabatan</p>
                                    <p class="text-sm mt-1">
                                        <a href="{{ route('jabatan-lembaga.create') }}" class="text-blue-600 hover:underline">
                                            Tambah jabatan
                                        </a> untuk memulai
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($jabatan->hasPages())
        <div class="px-4 py-3 border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between">
                {{-- Info jumlah data --}}
                <div class="mb-3 md:mb-0 text-sm text-gray-700">
                    Menampilkan 
                    <span class="font-medium">{{ $jabatan->firstItem() }}</span> 
                    sampai 
                    <span class="font-medium">{{ $jabatan->lastItem() }}</span> 
                    dari 
                    <span class="font-medium">{{ $jabatan->total() }}</span> 
                    jabatan
                </div>
                
                {{-- Navigasi halaman --}}
                <div class="flex items-center space-x-1">
                    {{-- Previous Page Link --}}
                    @if($jabatan->onFirstPage())
                        <span class="px-3 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            &laquo;
                        </span>
                    @else
                        <a href="{{ $jabatan->previousPageUrl() }}{{ request()->hasAny(['search', 'lembaga_id', 'level']) ? '&' . http_build_query(request()->only(['search', 'lembaga_id', 'level'])) : '' }}"
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">
                            &laquo;
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $current = $jabatan->currentPage();
                        $last = $jabatan->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $jabatan->url(1) }}{{ request()->hasAny(['search', 'lembaga_id', 'level']) ? '&' . http_build_query(request()->only(['search', 'lembaga_id', 'level'])) : '' }}"
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">1</a>
                        @if($start > 2) <span class="px-2">...</span> @endif
                    @endif

                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $current)
                            <span class="px-3 py-1 border border-gray-300 rounded bg-blue-600 text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $jabatan->url($page) }}{{ request()->hasAny(['search', 'lembaga_id', 'level']) ? '&' . http_build_query(request()->only(['search', 'lembaga_id', 'level'])) : '' }}"
                               class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if($end < $last)
                        @if($end < $last - 1) <span class="px-2">...</span> @endif
                        <a href="{{ $jabatan->url($last) }}{{ request()->hasAny(['search', 'lembaga_id', 'level']) ? '&' . http_build_query(request()->only(['search', 'lembaga_id', 'level'])) : '' }}"
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">{{ $last }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($jabatan->hasMorePages())
                        <a href="{{ $jabatan->nextPageUrl() }}{{ request()->hasAny(['search', 'lembaga_id', 'level']) ? '&' . http_build_query(request()->only(['search', 'lembaga_id', 'level'])) : '' }}"
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">
                            &raquo;
                        </a>
                    @else
                        <span class="px-3 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            &raquo;
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

</div>
@endsection