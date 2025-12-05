@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Data Perangkat Desa</h1>

    <!-- SEARCH + BUTTON -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" class="flex items-center gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari jabatan..."
                class="px-3 py-2 border rounded w-64"
            >
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('perangkat_desa.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded">
                    Reset
                </a>
            @endif
        </form>

        <a href="{{ route('perangkat_desa.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded">
            Tambah Perangkat Desa
        </a>
    </div>

    <!-- TABLE -->
    @if($data->isEmpty())
        <div class="text-center py-8 text-gray-500">
            Data perangkat desa tidak ditemukan
        </div>
    @else
        <table class="w-full border text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Foto</th>
                    <th class="p-2 border">Jabatan</th>
                    <th class="p-2 border">Kontak</th>
                    <th class="p-2 border text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $p)
                <tr class="border">
                    <td class="p-2 border">{{ $p->perangkat_id }}</td>

                    <!-- FOTO -->
                    <td class="p-2 border text-center">
                        @if ($p->media->count() > 0)
                            <div class="flex justify-center">
                                <img 
                                    src="{{ asset('uploads/perangkat_desa/' . $p->media->first()->file_name) }}" 
                                    class="w-16 h-16 object-cover rounded"
                                    alt="Foto {{ $p->jabatan }}"
                                >
                            </div>
                        @else
                            <span class="text-gray-500 text-sm">Tidak ada foto</span>
                        @endif
                    </td>

                    <td class="p-2 border">{{ $p->jabatan }}</td>
                    <td class="p-2 border">{{ $p->kontak }}</td>

                    <!-- AKSI -->
                    <td class="p-2 border text-center">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('perangkat_desa.show', $p->perangkat_id) }}"
                               class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                Detail
                            </a>

                            <a href="{{ route('perangkat_desa.edit', $p->perangkat_id) }}"
                               class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                                Edit
                            </a>

                            <!-- TOMBOL HAPUS DATA PERANGKAT -->
                            <form action="{{ route('perangkat_desa.destroy', $p->perangkat_id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data perangkat desa ini? Data yang dihapus termasuk foto tidak dapat dikembalikan.')" 
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

        <!-- PAGINATION -->
        @if($data->hasPages())
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <!-- Info results -->
                <div class="text-sm text-gray-700 mb-2 sm:mb-0">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
                </div>
                
                <!-- Navigation -->
                <div class="flex items-center space-x-2">
                    <!-- Previous Button -->
                    @if($data->onFirstPage())
                        <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                            &laquo; Previous
                        </span>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
                            &laquo; Previous
                        </a>
                    @endif
                    
                    <!-- Page Numbers -->
                    <div class="flex items-center space-x-1">
                        @foreach($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if($page == $data->currentPage())
                                <span class="px-3 py-1 bg-blue-600 text-white rounded">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Next Button -->
                    @if($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
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

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@endsection