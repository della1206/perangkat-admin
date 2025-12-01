@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Data Perangkat Desa</h1>

    <!-- SEARCH + BUTTON -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" class="flex-1 mr-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari warga atau jabatan..."
                class="px-3 py-2 border rounded w-1/3"
            >
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Cari</button>
        </form>

        <a href="{{ route('perangkat_desa.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded">
            Tambah Perangkat Desa
        </a>
    </div>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Foto</th>
                <th class="p-2 border">Warga</th>
                <th class="p-2 border">Jabatan</th>
                <th class="p-2 border">Kontak</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $p)
            <tr>
                <td class="p-2 border">{{ $p->perangkat_id }}</td>

                <!-- FOTO -->
                <td class="p-2 border">
                        @if ($p->media->count() > 0)
                            <img src="{{ asset('storage/uploads/perangkat_desa/' . $p->media->first()->file_name) }}"
                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span class="text-gray-500 text-sm">Tidak ada foto</span>
                        @endif
                    </td>

                <td class="p-2 border">{{ $p->warga_id }}</td>
                <td class="p-2 border">{{ $p->jabatan }}</td>
                <td class="p-2 border">{{ $p->kontak }}</td>

                <td class="p-2 border">
                    <a href="{{ route('perangkat_desa.edit', $p->perangkat_id) }}" class="text-blue-600">Edit</a>
                    |
                    <form action="{{ route('perangkat_desa.destroy', $p->perangkat_id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus data?')" class="text-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $data->links('pagination::bootstrap-5') }}
</div>
@endsection
