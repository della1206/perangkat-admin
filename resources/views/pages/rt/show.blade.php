@extends('layouts.admin.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Detail RT {{ $rt->nomor_rt }}</h1>
            <p class="text-gray-500">Informasi lengkap Rukun Tetangga</p>
        </div>
        <a href="{{ route('rt.edit', $rt->rt_id) }}" 
           class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg">
            Edit
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Info RT --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Informasi RT</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">RW</p>
                    <p class="font-medium">RW {{ $rt->rw->nomor_rw }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nomor RT</p>
                    <p class="font-medium">{{ $rt->nomor_rt }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Keterangan</p>
                    <p class="font-medium">{{ $rt->keterangan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dibuat</p>
                    <p class="font-medium">{{ $rt->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Ketua RT --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Ketua RT</h2>
            @if($rt->ketuaRt)
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-2xl text-gray-400"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $rt->ketuaRt->nama }}</h3>
                        <p class="text-gray-600">{{ $rt->ketuaRt->no_ktp }}</p>
                        <div class="flex gap-2 mt-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                                {{ $rt->ketuaRt->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
                                {{ $rt->ketuaRt->agama }}
                            </span>
                        </div>
                        <div class="mt-3 space-y-1">
                            <p class="text-sm"><i class="fas fa-phone mr-2"></i>{{ $rt->ketuaRt->telp ?? '-' }}</p>
                            <p class="text-sm"><i class="fas fa-envelope mr-2"></i>{{ $rt->ketuaRt->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-user-slash text-4xl mb-3"></i>
                    <p>Belum ada ketua RT</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection