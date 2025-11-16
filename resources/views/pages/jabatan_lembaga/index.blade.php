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
                            Tidak ada data jabatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>
@endsection
