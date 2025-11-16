@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Data Lembaga Desa</h1>

        <a href="{{ route('lembaga.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Tambah
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">No</th>
                <th class="border px-3 py-2">Nama</th>
                <th class="border px-3 py-2">Ketua</th>
                <th class="border px-3 py-2">Deskripsi</th>
                <th class="border px-3 py-2">Kontak</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($lembaga as $item)
                <tr>
                    <td class="border px-3 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border px-3 py-2">{{ $item->nama_lembaga }}</td>
                    <td class="border px-3 py-2">{{ $item->ketua }}</td>
                    <td class="border px-3 py-2">{{ $item->deskripsi }}</td>
                    <td class="border px-3 py-2">{{ $item->kontak }}</td>

                    <td class="border px-3 py-2 text-center flex justify-center gap-2">

                        <a href="{{ route('lembaga.edit', $item->lembaga_id) }}"
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
