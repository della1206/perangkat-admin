@extends('layouts.admin.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-semibold mb-6">Edit Jabatan Lembaga</h2>

    <form action="{{ route('jabatan.update', $jabatan->jabatan_id) }}" method="POST" class="space-y-5 w-full max-w-lg">
        @csrf
        @method('PUT')

        {{-- LEMBAGA --}}
        <div>
            <label class="block font-medium mb-1">Lembaga</label>
            <select name="lembaga_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300">
                @foreach($lembaga as $l)
                    <option value="{{ $l->lembaga_id }}" 
                        {{ $l->lembaga_id == $jabatan->lembaga_id ? 'selected' : '' }}>
                        {{ $l->nama_lembaga }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- NAMA JABATAN --}}
        <div>
            <label class="block font-medium mb-1">Nama Jabatan</label>
            <input type="text" name="nama_jabatan"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300"
                value="{{ $jabatan->nama_jabatan }}">
        </div>

        {{-- LEVEL --}}
        <div>
            <label class="block font-medium mb-1">Level</label>
            <input type="number" name="level"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-300"
                value="{{ $jabatan->level }}">
        </div>

        {{-- TOMBOL --}}
        <div>
            <button
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Update
            </button>
        </div>

    </form>

</div>
@endsection
