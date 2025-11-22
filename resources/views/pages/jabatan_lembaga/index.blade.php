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
        <h1 class="text-2xl font-bold text-gray-800">Jabatan Lembaga</h1>

        <a href="{{ route('jabatan-lembaga.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            Tambah
        </a>
    </div>

    {{-- FORM FILTER DAN SEARCH --}}
    <form method="GET" action="{{ route('jabatan-lembaga.index') }}" class="mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex flex-wrap gap-4 items-end">
                {{-- Filter Lembaga --}}
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lembaga</label>
                    <select name="lembaga_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Lembaga</option>
                        @foreach($lembagaList as $lembaga)
                            <option value="{{ $lembaga->lembaga_id }}" {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                {{ $lembaga->nama_lembaga }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Level --}}
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Level</option>
                        <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                        <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                        <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                        <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
                        <option value="5" {{ request('level') == '5' ? 'selected' : '' }}>Level 5</option>
                    </select>
                </div>

                {{-- Search --}}
                <div class="flex-1 min-w-[250px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari jabatan..." 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Clear Search --}}
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow text-sm whitespace-nowrap">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Tombol Filter --}}
                <div class="flex gap-2">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Filter
                    </button>
                    <a href="{{ route('jabatan-lembaga.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                        Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
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
                        <td class="py-2 px-4 border text-center">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border">{{ $item->lembaga->nama_lembaga ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $item->nama_jabatan }}</td>
                        <td class="py-2 px-4 border text-center">{{ $item->level }}</td>

                        <td class="py-2 px-4 border text-center">
                            <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}"
                               class="text-blue-600 hover:text-blue-800 text-xl mr-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}"
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus jabatan ini?')"
                                        class="text-red-600 hover:text-red-800 text-xl">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 border text-center text-gray-500">
                            @if(request()->anyFilled(['lembaga_id', 'level', 'search']))
                                Tidak ada data jabatan yang sesuai dengan filter.
                            @else
                                Tidak ada data jabatan.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $jabatan->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection