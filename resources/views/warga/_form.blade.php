<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">No KTP</label>
            <input type="text" name="no_ktp" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('no_ktp', $warga->no_ktp ?? '') }}" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('nama', $warga->nama ?? '') }}" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Agama</label>
            <input type="text" name="agama" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('agama', $warga->agama ?? '') }}">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Telp</label>
            <input type="text" name="telp" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('telp', $warga->telp ?? '') }}">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"
                value="{{ old('email', $warga->email ?? '') }}">
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitButtonText }}
        </button>
        <a href="{{ route('warga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>
</div>
