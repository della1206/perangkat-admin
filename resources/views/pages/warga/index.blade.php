@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">👨‍👩‍👧‍👦 Data Warga</h1>

    <a href="{{ route('warga.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700">
        + Tambah Warga
    </a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">No KTP</th>
                <th class="border px-4 py-2 text-left">Nama</th>
                <th class="border px-4 py-2 text-left">JK</th>
                <th class="border px-4 py-2 text-left">Agama</th>
                <th class="border px-4 py-2 text-left">Pekerjaan</th>
                <th class="border px-4 py-2 text-left">Telp</th>
                <th class="border px-4 py-2 text-left">Email</th>
                <th class="border px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($warga as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->no_ktp }}</td>
                <td class="border px-4 py-2">{{ $item->nama }}</td>
                <td class="border px-4 py-2">{{ $item->jk }}</td>
                <td class="border px-4 py-2">{{ $item->agama }}</td>
                <td class="border px-4 py-2">{{ $item->pekerjaan }}</td>
                <td class="border px-4 py-2">{{ $item->telp }}</td>
                <td class="border px-4 py-2">{{ $item->email }}</td>
                <td class="border px-4 py-2 text-center">
                   <a href="{{ route('warga.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a> |
<form action="{{ route('warga.destroy', $item) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
</form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="border px-4 py-2 text-center text-gray-500">Belum ada data warga.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
