@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold mb-2">👨‍👩‍👧‍👦 Data Warga</h1>
            <p class="text-gray-600">Kelola data warga desa</p>
        </div>
        
        <a href="{{ route('warga.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Warga
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter dan Search -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" action="{{ route('warga.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Filter Jenis Kelamin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" 
                        class="border border-gray-300 rounded p-2 w-full md:w-40"
                        onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Filter Agama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                <select name="agama" 
                        class="border border-gray-300 rounded p-2 w-full md:w-40"
                        onchange="this.form.submit()">
                    <option value="">Semua Agama</option>
                    <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <!-- Search -->
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <div class="flex gap-2">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama, no KTP, email..." 
                           class="border border-gray-300 rounded p-2 flex-1">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Cari
                    </button>
                    @if(request()->hasAny(['search', 'jenis_kelamin', 'agama']))
                    <a href="{{ route('warga.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Reset
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">No KTP</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">JK</th>
                    <th class="border px-4 py-2 text-left">Agama</th>
                    <th class="border px-4 py-2 text-left">Pekerjaan</th>
                    <th class="border px-4 py-2 text-left">Telp</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($warga as $item)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $item->no_ktp }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">
                        @if($item->jenis_kelamin == 'L')
                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Laki-laki</span>
                        @else
                        <span class="px-2 py-1 text-xs bg-pink-100 text-pink-800 rounded">Perempuan</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $item->agama }}</td>
                    <td class="border px-4 py-2">{{ $item->pekerjaan }}</td>
                    <td class="border px-4 py-2">{{ $item->telp }}</td>
                    <td class="border px-4 py-2">{{ $item->email }}</td>
                    <td class="border px-4 py-2 text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- PERBAIKAN: Gunakan $item langsung, bukan $item->id -->
                            <a href="{{ route('warga.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                            <span class="text-gray-400">|</span>
                            <form action="{{ route('warga.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                        class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="border px-4 py-8 text-center text-gray-500">
                        @if(request()->hasAny(['search', 'jenis_kelamin', 'agama']))
                            Data tidak ditemukan dengan filter yang dipilih
                        @else
                            Belum ada data warga.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($warga->hasPages())
    <div class="mt-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 text-sm text-gray-700">
                Menampilkan {{ $warga->firstItem() }} sampai {{ $warga->lastItem() }} dari {{ $warga->total() }} data
            </div>
            
            <div class="flex items-center space-x-1">
                {{-- Previous Page Link --}}
                @if($warga->onFirstPage())
                    <span class="px-3 py-1 border rounded text-gray-400">&laquo;</span>
                @else
                    <a href="{{ $warga->previousPageUrl() }}{{ request()->hasAny(['search', 'jenis_kelamin', 'agama']) ? '&' . http_build_query(request()->only(['search', 'jenis_kelamin', 'agama'])) : '' }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">&laquo;</a>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $current = $warga->currentPage();
                    $last = $warga->lastPage();
                    $start = max(1, $current - 1);
                    $end = min($last, $current + 1);
                @endphp

                @if($start > 1)
                    <a href="{{ $warga->url(1) }}{{ request()->hasAny(['search', 'jenis_kelamin', 'agama']) ? '&' . http_build_query(request()->only(['search', 'jenis_kelamin', 'agama'])) : '' }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">1</a>
                    @if($start > 2) <span class="px-2">...</span> @endif
                @endif

                @for($page = $start; $page <= $end; $page++)
                    @if($page == $current)
                        <span class="px-3 py-1 border rounded bg-blue-600 text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $warga->url($page) }}{{ request()->hasAny(['search', 'jenis_kelamin', 'agama']) ? '&' . http_build_query(request()->only(['search', 'jenis_kelamin', 'agama'])) : '' }}"
                           class="px-3 py-1 border rounded hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endfor

                @if($end < $last)
                    @if($end < $last - 1) <span class="px-2">...</span> @endif
                    <a href="{{ $warga->url($last) }}{{ request()->hasAny(['search', 'jenis_kelamin', 'agama']) ? '&' . http_build_query(request()->only(['search', 'jenis_kelamin', 'agama'])) : '' }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">{{ $last }}</a>
                @endif

                {{-- Next Page Link --}}
                @if($warga->hasMorePages())
                    <a href="{{ $warga->nextPageUrl() }}{{ request()->hasAny(['search', 'jenis_kelamin', 'agama']) ? '&' . http_build_query(request()->only(['search', 'jenis_kelamin', 'agama'])) : '' }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">&raquo;</a>
                @else
                    <span class="px-3 py-1 border rounded text-gray-400">&raquo;</span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection