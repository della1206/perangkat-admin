@extends('layouts.admin.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Perangkat Desa</h2>

    {{-- Filter dan Search --}}
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form method="GET" action="{{ route('perangkat-desa.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama, jabatan, atau NIP..." 
                       class="w-full border border-gray-300 rounded-lg p-2">
            </div>
            
            <div class="w-full md:w-48">
                <select name="jabatan" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Semua Jabatan</option>
                    @foreach($jabatanList as $jabatan)
                        <option value="{{ $jabatan }}" {{ request('jabatan') == $jabatan ? 'selected' : '' }}>
                            {{ $jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                
                @if(request('search') || request('jabatan'))
                    <a href="{{ route('perangkat-desa.index') }}" 
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Total: {{ $perangkat->total() }} data
        </div>
        
        <a href="{{ route('perangkat-desa.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>Tambah Perangkat
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($perangkat as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ ($perangkat->currentPage() - 1) * $perangkat->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" 
                                     alt="Foto {{ $item->warga->nama }}" 
                                     class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $item->warga->nama }}</div>
                            <div class="text-sm text-gray-500">KTP: {{ $item->warga->no_ktp }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $item->jabatan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->nip ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->kontak }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ \Carbon\Carbon::parse($item->periode_mulai)->format('d/m/Y') }}
                            @if($item->periode_selesai)
                                <br><span class="text-gray-500">s/d</span><br>
                                {{ \Carbon\Carbon::parse($item->periode_selesai)->format('d/m/Y') }}
                            @else
                                <br><span class="text-gray-500 text-xs">Sekarang</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('perangkat-desa.show', $item->perangkat_id) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('perangkat-desa.edit', $item->perangkat_id) }}" 
                                   class="text-green-600 hover:text-green-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('perangkat-desa.destroy', $item->perangkat_id) }}" 
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $perangkat->links('pagination::tailwind') }}
    </div>
</div>
@endsection