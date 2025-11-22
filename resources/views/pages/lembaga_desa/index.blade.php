@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Lembaga Desa</h1>

        <a href="{{ route('lembaga.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Tambah
        </a>
    </div>

    <!-- FORM SEARCH -->
    <form method="GET" action="{{ route('lembaga.index') }}" class="mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border">
            <div class="flex flex-wrap gap-4 items-end">
                <!-- Search -->
                <div class="flex-1 min-w-[300px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari nama lembaga, deskripsi, atau kontak..." 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow text-sm whitespace-nowrap flex items-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Terapkan
                    </button>
                    <a href="{{ route('lembaga.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                        Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Nama Lembaga</th>
                    <th class="border px-3 py-2">Deskripsi</th>
                    <th class="border px-3 py-2">Kontak</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
<<<<<<< HEAD
            </thead>

            <tbody>
                @forelse ($lembaga as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">{{ ($lembaga->currentPage() - 1) * $lembaga->perPage() + $index + 1 }}</td>
                        <td class="border px-3 py-2">{{ $item->nama_lembaga }}</td>
                        <td class="border px-3 py-2">{{ Str::limit($item->deskripsi, 50) }}</td>
                        <td class="border px-3 py-2">{{ $item->kontak ?? '-' }}</td>

                        <td class="border px-3 py-2 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('lembaga.edit', $item->lembaga_id) }}"
                                   class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-3 py-2 text-center text-gray-500">
                            @if(request('search'))
                                Tidak ada data lembaga yang sesuai dengan pencarian "{{ request('search') }}".
                            @else
                                Belum ada data lembaga.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
=======
            @endforeach
        </tbody>
    </table>
     <div class="mt-3">
>>>>>>> 69431c22075e6e06bc46eb911ace1883b6ca516a
        {{ $lembaga->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection