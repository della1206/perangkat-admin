@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-semibold mb-6">Tambah Jabatan Lembaga</h2>

       @if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-3">
        {{ session('success') }}
    </div>
@endif

    <table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">No</th>
            <th class="p-2 border">Nama Jabatan</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jabatan as $item)
        <tr>
            <td class="border p-2">{{ $loop->iteration }}</td>
            <td class="border p-2">{{ $item->nama_jabatan }}</td>
            <td class="border p-2">
                <a href="{{ route('jabatan.edit', $item->id) }}" class="text-blue-600">Edit</a>
                |
                <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-600">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    

    <form action="{{ route('jabatan.store') }}" method="POST" class="space-y-5 w-full max-w-lg">
        @csrf

        {{-- LEMBAGA --}}
        <div>
            <label class="block font-medium mb-1">Lembaga</label>
            <select name="lembaga_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300">

                @foreach($lembaga as $l)
                    <option value="{{ $l->id }}">{{ $l->nama_lembaga }}</option>
                @endforeach

            </select>
        </div>

        {{-- NAMA JABATAN --}}
        <div>
            <label class="block font-medium mb-1">Nama Jabatan</label>
            <input type="text" name="nama_jabatan"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300"
                placeholder="Contoh: Ketua, Bendahara ...">
        </div>

        {{-- LEVEL --}}
        <div>
            <label class="block font-medium mb-1">Level</label>
            <input type="number" name="level"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300"
                placeholder="Contoh: 1">
        </div>

        {{-- TOMBOL --}}
        <div>
            <button
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Simpan
            </button>
        </div>

    </form>

</div>
@endsection
