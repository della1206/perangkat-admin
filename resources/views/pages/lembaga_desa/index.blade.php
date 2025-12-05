@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Lembaga Desa</h1>
        
        <a href="{{ route('lembaga.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            Tambah Lembaga
        </a>
    </div>

    @if($lembaga->isEmpty())
        <div class="text-center py-8 text-gray-500">
            Tidak ada data lembaga.
        </div>
    @else
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border text-center w-12">No</th>
                    <th class="p-2 border">Logo</th>
                    <th class="p-2 border">Nama Lembaga</th>
                    <th class="p-2 border">Deskripsi</th>
                    <th class="p-2 border">Kontak</th>
                    <th class="p-2 border text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($lembaga as $i => $row)
                    <tr class="border hover:bg-gray-50">
                        <td class="p-2 text-center">
                            {{ ($lembaga->currentPage() - 1) * $lembaga->perPage() + $loop->iteration }}
                        </td>

                        {{-- LOGO --}}
                        <td class="p-2 text-center">
                            @php
                                $logo = $row->media->first();
                            @endphp

                            @if ($logo)
                                <img src="{{ asset('uploads/'.$logo->file_name) }}"
                                     class="w-14 h-14 object-cover rounded border mx-auto">
                            @else
                                <span class="text-gray-400 text-sm">No Logo</span>
                            @endif
                        </td>

                        {{-- NAMA --}}
                        <td class="p-2">{{ $row->nama_lembaga }}</td>

                        {{-- DESKRIPSI --}}
                        <td class="p-2">
                            {{ \Illuminate\Support\Str::limit($row->deskripsi, 100) }}
                        </td>

                        {{-- KONTAK --}}
                        <td class="p-2">
                            @if ($row->kontak)
                                {{ $row->kontak }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="p-2">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('lembaga.show', $row->lembaga_id) }}"
                                   class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                                    Detail
                                </a>

                                <a href="{{ route('lembaga.edit', $row->lembaga_id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded text-sm hover:bg-yellow-600">
                                    Edit
                                </a>

                                {{-- TOMBOL HAPUS LEMBAGA --}}
                                <form action="{{ route('lembaga.destroy', $row->lembaga_id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Hapus data lembaga ini? Data yang dihapus tidak dapat dikembalikan.')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        @if($lembaga->hasPages())
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <!-- Info results -->
                <div class="text-sm text-gray-700 mb-2 sm:mb-0">
                    Showing {{ $lembaga->firstItem() }} to {{ $lembaga->lastItem() }} of {{ $lembaga->total() }} results
                </div>
                
                <!-- Navigation -->
                <div class="flex items-center space-x-2">
                    <!-- Previous Button -->
                    @if($lembaga->onFirstPage())
                        <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                            &laquo; Previous
                        </span>
                    @else
                        <a href="{{ $lembaga->previousPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
                            &laquo; Previous
                        </a>
                    @endif
                    
                    <!-- Page Numbers -->
                    <div class="flex items-center space-x-1">
                        @php
                            $currentPage = $lembaga->currentPage();
                            $lastPage = $lembaga->lastPage();
                            
                            // Tentukan rentang halaman yang ditampilkan
                            $start = max(1, $currentPage - 4);
                            $end = min($lastPage, $currentPage + 5);
                            
                            // Jika terlalu dekat dengan awal, geser ke kanan
                            if ($currentPage <= 5) {
                                $end = min(10, $lastPage);
                            }
                            
                            // Jika terlalu dekat dengan akhir, geser ke kiri
                            if ($currentPage >= $lastPage - 4) {
                                $start = max(1, $lastPage - 9);
                            }
                        @endphp
                        
                        @if($start > 1)
                            <a href="{{ $lembaga->url(1) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                1
                            </a>
                            @if($start > 2)
                                <span class="px-2 text-gray-500">...</span>
                            @endif
                        @endif
                        
                        @for($page = $start; $page <= $end; $page++)
                            @if($page == $currentPage)
                                <span class="px-3 py-1 bg-blue-600 text-white rounded">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $lembaga->url($page) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor
                        
                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="px-2 text-gray-500">...</span>
                            @endif
                            <a href="{{ $lembaga->url($lastPage) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                {{ $lastPage }}
                            </a>
                        @endif
                    </div>
                    
                    <!-- Next Button -->
                    @if($lembaga->hasMorePages())
                        <a href="{{ $lembaga->nextPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
                            Next &raquo;
                        </a>
                    @else
                        <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                            Next &raquo;
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endif
</div>
@endsection