@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Data RW</h1>
            <p class="text-gray-500">Kelola data Rukun Warga (RW)</p>
        </div>
        <a href="{{ route('rw.create') }}" 
           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
            + Tambah RW
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('rw.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Search --}}
                <div>
                    <label class="block text-sm font-semibold mb-1">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nomor RW, keterangan, atau ketua..."
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                {{-- Sort --}}
                <div>
                    <label class="block text-sm font-semibold mb-1">Urutkan</label>
                    <select name="sort" class="w-full border px-3 py-2 rounded-lg">
                        <option value="nomor_rw" {{ request('sort') == 'nomor_rw' ? 'selected' : '' }}>Nomor RW</option>
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
                <a href="{{ route('rw.index') }}" 
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
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nomor RW</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Ketua RW</th>
                        <th class="px6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                        <th class="px6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jumlah RT</th>
                        <th class="px6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($rw as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration + ($rw->currentPage() - 1) * $rw->perPage() }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $item->nomor_rw }}</td>
                        <td class="px-6 py-4">
                            @if($item->ketuaRw)
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p class="font-medium">{{ $item->ketuaRw->nama }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->ketuaRw->no_ktp }}</p>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400">Belum ditentukan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $item->keterangan ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                {{ $item->rts_count ?? 0 }} RT
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('rw.show', $item->rw_id) }}" 
                                   class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded text-sm">
                                    Detail
                                </a>
                                <a href="{{ route('rw.edit', $item->rw_id) }}" 
                                   class="px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('rw.destroy', $item->rw_id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus RW {{ $item->nomor_rw }}?')">
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
                            <p>Tidak ada data RW</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($rw->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $rw->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection