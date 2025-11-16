@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">JABATAN LEMBAGA</h1>
            <p class="text-gray-500">Portal Desa Mandiri - Midsipant dengan Sepenuh Hati</p>
        </div>

        <a href="{{ route('jabatan-lembaga.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center shadow">
            <span class="text-xl mr-1">＋</span> Tambah Jabatan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-3 border text-center w-12">No</th>
                        <th class="px-4 py-3 border">Nama Lembaga</th>
                        <th class="px-4 py-3 border">Nama Jabatan</th>
                        <th class="px-4 py-3 border text-center w-20">Level</th>
                        <th class="px-4 py-3 border text-center w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jabatan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $item->lembaga->nama_lembaga ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama_jabatan }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->level }}</td>

                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    ✎
                                </a>

                                <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}"
                                      method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus jabatan ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 border text-center text-gray-500">
                                Tidak ada data jabatan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
