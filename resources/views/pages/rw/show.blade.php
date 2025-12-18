@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Detail RW {{ $rw->nomor_rw }}</h1>
            <p class="text-gray-500">Informasi lengkap Rukun Warga</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('rw.edit', $rw->rw_id) }}" 
               class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg">
                Edit
            </a>
            <a href="{{ route('rt.create') }}?rw_id={{ $rw->rw_id }}" 
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                + Tambah RT
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Info RW --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Informasi RW</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Nomor RW</p>
                    <p class="font-medium">{{ $rw->nomor_rw }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Keterangan</p>
                    <p class="font-medium">{{ $rw->keterangan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dibuat</p>
                    <p class="font-medium">{{ $rw->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Ketua RW --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Ketua RW</h2>
            @if($rw->ketuaRw)
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-2xl text-gray-400"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $rw->ketuaRw->nama }}</h3>
                        <p class="text-gray-600">{{ $rw->ketuaRw->no_ktp }}</p>
                        <div class="flex gap-2 mt-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                                {{ $rw->ketuaRw->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
                                {{ $rw->ketuaRw->agama }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-user-slash text-4xl mb-3"></i>
                    <p>Belum ada ketua RW</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Daftar RT --}}
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Daftar RT di RW {{ $rw->nomor_rw }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nomor RT</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Ketua RT</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($rw->rts as $rt)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $rt->nomor_rt }}</td>
                        <td class="px-6 py-4">
                            @if($rt->ketuaRt)
                                {{ $rt->ketuaRt->nama }}
                            @else
                                <span class="text-gray-400">Belum ditentukan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $rt->keterangan ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('rt.edit', $rt->rt_id) }}" 
                                   class="px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded text-sm">
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <div class="mb-3">
                                <i class="fas fa-inbox text-4xl text-gray-300"></i>
                            </div>
                            <p>Belum ada RT di RW ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection