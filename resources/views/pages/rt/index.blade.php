@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Data RT</h1>
            <p class="text-gray-500">Kelola data Rukun Tetangga (RT)</p>
        </div>
        <a href="{{ route('rt.create') }}" 
           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
            + Tambah RT
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('rt.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search --}}
                <div>
                    <label class="block text-sm font-semibold mb-1">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nomor RT, ketua, atau keterangan..."
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                {{-- Filter RW --}}
                <div>
                    <label class="block text-sm font-semibold mb-1">Filter RW</label>
                    <select name="rw_id" class="w-full border px-3 py-2 rounded-lg">
                        <option value="">Semua RW</option>
                        @foreach ($rwList as $rw)
                            <option value="{{ $rw->rw_id }}" {{ request('rw_id') == $rw->rw_id ? 'selected' : '' }}>
                                RW {{ $rw->nomor_rw }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sort --}}
                <div>
                    <label class="block text-sm font-semibold mb-1">Urutkan</label>
                    <select name="sort" class="w-full border px-3 py-2 rounded-lg">
                        <option value="nomor_rt" {{ request('sort') == 'nomor_rt' ? 'selected' : '' }}>Nomor RT</option>
                        <option value="keterangan" {{ request('sort') == 'keterangan' ? 'selected' : '' }}>Keterangan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Arah</label>
                    <select name="order" class="w-full border px-3 py-2 rounded-lg">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A - Z</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z - A</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('rt.index') }}" 
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Reset
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Terapkan
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">RW</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nomor RT</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Ketua RT</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($rt as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration + ($rt->currentPage() - 1) * $rt->perPage() }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                RW {{ $item->rw->nomor_rw }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $item->nomor_rt }}</td>
                        <td class="px-6 py-4">
                            @if($item->ketuaRt)
                                <div>
                                    <p class="font-medium">{{ $item->ketuaRt->nama }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->ketuaRt->telp }}</p>
                                </div>
                            @else
                                <span class="text-gray-400">Belum ditentukan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $item->keterangan ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('rt.edit', $item->rt_id) }}" 
                                   class="px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('rt.destroy', $item->rt_id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus RT {{ $item->nomor_rt }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="mb-3">
                                <i class="fas fa-inbox text-4xl text-gray-300"></i>
                            </div>
                            <p>Tidak ada data RT</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($rt->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $rt->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection