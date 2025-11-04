<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1">No KTP</label>
            <input type="text" name="no_ktp"
                   class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('no_ktp') border-red-500 @enderror"
                   value="{{ old('no_ktp', $warga->no_ktp ?? '') }}" required>
            @error('no_ktp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="nama"
                   class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('nama') border-red-500 @enderror"
                   value="{{ old('nama', $warga->nama ?? '') }}" required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('jenis_kelamin') border-red-500 @enderror">
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Agama</label>
            <select name="agama" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('agama') border-red-500 @enderror">
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" {{ old('agama', $warga->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $warga->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $warga->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $warga->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $warga->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $warga->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
            @error('agama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Pekerjaan</label>
            <input type="text" name="pekerjaan"
                   class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('pekerjaan') border-red-500 @enderror"
                   value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}">
            @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Telp</label>
            <input type="text" name="telp"
                   class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('telp') border-red-500 @enderror"
                   value="{{ old('telp', $warga->telp ?? '') }}">
            @error('telp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email"
                   class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror"
                   value="{{ old('email', $warga->email ?? '') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
            {{ $submitButtonText }}
        </button>
        <a href="{{ route('warga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
            Kembali
        </a>
    </div>
</div>
