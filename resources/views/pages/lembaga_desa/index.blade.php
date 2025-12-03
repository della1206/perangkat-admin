@extends('layouts.admin.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Daftar Lembaga Desa</h1>

    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Logo</th>
                <th class="p-2 border">Nama Lembaga</th>
                <th class="p-2 border">Deskripsi</th>
                <th class="p-2 border">Kontak</th> <!-- KOLOM BARU -->
                <th class="p-2 border text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($lembaga as $i => $row)
                <tr class="border">
                    <td class="p-2 text-center">{{ $i + 1 }}</td>

                    {{-- LOGO --}}
                    <td class="p-2 text-center">
                        @php
                            $logo = $row->media->first();
                        @endphp

                        @if ($logo)
                            <img src="{{ asset('uploads/'.$logo->file_name) }}"
                                 class="w-14 h-14 object-cover rounded border">
                        @else
                            <span class="text-gray-400">No Logo</span>
                        @endif
                    </td>

                    {{-- NAMA --}}
                    <td class="p-2">{{ $row->nama_lembaga }}</td>

                    {{-- DESKRIPSI --}}
                    <td class="p-2">
                        {{ \Illuminate\Support\Str::limit($row->deskripsi, 100) }}
                    </td>

                    {{-- KONTAK --}}
                    <td class="p-2">
                        @if ($row->kontak)
                            {{ $row->kontak }}
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="p-2">
                        <div class="flex gap-2 justify-center">

                            <a href="{{ route('lembaga.show', $row->lembaga_id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded">
                                Detail
                            </a>

                            <a href="{{ route('lembaga.edit', $row->lembaga_id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </a>

                            {{-- TOMBOL HAPUS LEMBAGA --}}
                            <form action="{{ route('lembaga.destroy', $row->lembaga_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus data lembaga ini? Data yang dihapus tidak dapat dikembalikan.')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        class="px-3 py-1 bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="mt-4">
        {{ $lembaga->links() }}
    </div>
</div>
@endsection