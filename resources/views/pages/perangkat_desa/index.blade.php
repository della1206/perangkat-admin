@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Data Perangkat Desa</h1>

    <!-- SEARCH + BUTTON -->
    <div class="flex items-center justify-between mb-4">
        <form method="GET" class="flex items-center gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari jabatan..."
                class="px-3 py-2 border rounded w-64"
            >
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Cari
            </button>
        </form>

        <a href="{{ route('perangkat_desa.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded">
            Tambah Perangkat Desa
        </a>
    </div>

    <!-- TABLE -->
    <table class="w-full border text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Foto</th>
                <th class="p-2 border">Jabatan</th>
                <th class="p-2 border">Kontak</th>
                <th class="p-2 border text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $p)
            <tr class="border">

                <td class="p-2 border">{{ $p->perangkat_id }}</td>

                <!-- FOTO -->
                <td class="p-2 border text-center">
                    @if ($p->media->count() > 0)
                        <div class="flex justify-center">
                            <img 
                                src="{{ asset('uploads/perangkat_desa/' . $p->media->first()->file_name) }}" 
                                class="w-16 h-16 object-cover rounded"
                            >
                        </div>
                    @else
                        <span class="text-gray-500 text-sm">Tidak ada foto</span>
                    @endif
                </td>

                <td class="p-2 border">{{ $p->jabatan }}</td>
                <td class="p-2 border">{{ $p->kontak }}</td>

                <!-- AKSI -->
                <td class="p-2 border text-center">
                    <div class="flex justify-center items-center gap-4">

                        <a href="{{ route('perangkat_desa.show', $p->perangkat_id) }}"
                           class="text-green-600 font-semibold hover:underline">
                            Detail
                        </a>

                        <a href="{{ route('perangkat_desa.edit', $p->perangkat_id) }}"
                           class="text-blue-600 font-semibold hover:underline">
                            Edit
                        </a>

                        @if ($p->media->count() > 0)
                        <form action="{{ route('media.perangkat_desa.delete', $p->media->first()->media_id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus foto perangkat desa?')" 
                                    class="text-red-600 font-semibold hover:underline">
                                Hapus
                            </button>
                        </form>
                        @endif

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
