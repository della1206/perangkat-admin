@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👨‍👩‍👧‍👦 Data Warga</h1>
        <a href="{{ route('warga.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Warga
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM FILTER DAN SEARCH -->
    <form method="GET" action="{{ route('warga.index') }}" class="mb-6">
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
                                   placeholder="Cari NIK, nama, telp, atau email..." 
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

                <!-- Filter Jenis Kelamin -->
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Filter Agama -->
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                    <select name="agama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Agama</option>
                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Terapkan
                    </button>
                    <a href="{{ route('warga.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                        Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
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
                @forelse($warga as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ ($warga->currentPage() - 1) * $warga->perPage() + $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $item->no_ktp }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">
                        @if($item->jenis_kelamin == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $item->agama }}</td>
                    <td class="border px-4 py-2">{{ $item->pekerjaan }}</td>
                    <td class="border px-4 py-2">{{ $item->telp ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->email ?? '-' }}</td>
                    <td class="border px-4 py-2 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="border px-4 py-2 text-center text-gray-500">
                        @if(request()->anyFilled(['search', 'jenis_kelamin', 'agama', 'pekerjaan']))
                            Tidak ada data warga yang sesuai dengan filter.
                        @else
                            Belum ada data warga.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $warga->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection