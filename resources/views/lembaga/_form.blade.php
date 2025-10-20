@csrf

<div class="space-y-4">
    <div>
        <label class="block mb-1 font-semibold">Nama Lembaga</label>
        <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga ?? '') }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Ketua</label>
        <input type="text" name="ketua" value="{{ old('ketua', $lembaga->ketua ?? '') }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Bidang</label>
        <input type="text" name="bidang" value="{{ old('bidang', $lembaga->bidang ?? '') }}" class="w-full border px-3 py-2 rounded" placeholder="Contoh: Keagamaan, Pendidikan, Sosial">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Alamat</label>
        <textarea name="alamat" class="w-full border px-3 py-2 rounded" rows="3">{{ old('alamat', $lembaga->alamat ?? '') }}</textarea>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon', $lembaga->telepon ?? '') }}" class="w-full border px-3 py-2 rounded">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $lembaga->email ?? '') }}" class="w-full border px-3 py-2 rounded">
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitButtonText ?? 'Simpan' }}
        </button>
        <a href="{{ route('lembaga.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
</div>
