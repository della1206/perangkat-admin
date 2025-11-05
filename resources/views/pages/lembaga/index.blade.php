@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Data Lembaga Desa</h1>
        <a href="{{ route('lembaga.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Lembaga
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($lembagas->isEmpty())
        <p class="text-gray-600">Belum ada data lembaga desa.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">No</th>
                        <th class="border px-4 py-2 text-left">Nama Lembaga</th>
                        <th class="border px-4 py-2 text-left">Ketua</th>
                        <th class="border px-4 py-2 text-left">Bidang</th>
                        <th class="border px-4 py-2 text-left">Kontak</th>
                        <th class="border px-4 py-2 text-left">Deskripsi</th>
                        <th class="border px-4 py-2 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lembagas as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $item->nama_lembaga }}</td>
                            <td class="border px-4 py-2">{{ $item->ketua }}</td>
                            <td class="border px-4 py-2">{{ $item->bidang ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $item->kontak ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $item->deskripsi ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('lembaga.edit', $item->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('lembaga.destroy', $item->id) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
