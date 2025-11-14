@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-semibold mb-4">Data Jabatan Lembaga</h2>

    <a href="{{ route('jabatan.create') }}"
       class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
       + Tambah Jabatan
    </a>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Lembaga</th>
                    <th class="px-4 py-2">Nama Jabatan</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jabatan as $j)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $j->jabatan_id }}</td>
                    <td class="px-4 py-2">{{ $j->lembaga->nama_lembaga ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $j->nama_jabatan }}</td>
                    <td class="px-4 py-2">{{ $j->level }}</td>

                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('jabatan.edit', $j->jabatan_id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                           Edit
                        </a>
                        
                        <form action="{{ route('jabatan.store') }}" method="POST">
                       @csrf
                        <form action="{{ route('jabatan.destroy', $j->jabatan_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data ini?')"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                        Belum ada data jabatan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
