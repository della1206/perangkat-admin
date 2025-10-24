@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Warga</h2>

    <form action="{{ route('warga.create') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nama Warga</label>
            <input type="text" name="nama" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">NIK</label>
            <input type="text" name="nik" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Alamat</label>
            <input type="text" name="alamat" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Simpan
        </button>
=======
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Warga</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf   {{-- ini penting supaya tidak 419 --}}
        @include('warga._form', ['submitButtonText' => 'Simpan'])
>>>>>>> 59432ac6662f10f497865ea45af921c8593438ac
    </form>
</div>
@endsection
