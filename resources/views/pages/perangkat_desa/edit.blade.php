@extends('layouts.admin.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Perangkat Desa</h2>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit perangkat --}}
    <form action="{{ route('perangkat-desa.update', $perangkat->perangkat_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Informasi Warga --}}
            <div class="md:col-span-2">
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <h3 class="font-semibold text-gray-700 mb-2">Informasi Warga</h3>
                    <div class="flex items-center">
                        @if($perangkat->foto)
                            <img src="{{ Storage::url($perangkat->foto) }}" 
                                 alt="Foto {{ $perangkat->warga->nama }}" 
                                 class="w-16 h-16 rounded-full object-cover mr-4">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mr-4">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $perangkat->warga->nama }}</p>
                            <p class="text-sm text-gray-600">No. KTP: {{ $perangkat->warga->no_ktp }}</p>
                            <p class="text-sm text-gray-600">{{ $perangkat->warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}, {{ $perangkat->warga->agama }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Warga --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Pilih Warga</label>
                <select name="warga_id" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Pilih Warga</option>
                    @foreach($warga as $w)
                        <option value="{{ $w->warga_id }}" 
                                {{ old('warga_id', $perangkat->warga_id) == $w->warga_id ? 'selected' : '' }}>
                            {{ $w->nama }} ({{ $w->no_ktp }}) - {{ $w->pekerjaan }}
                        </option>
                    @endforeach
                </select>
                @error('warga_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $perangkat->jabatan) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Contoh: Kepala Desa" required>
                @error('jabatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIP --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">NIP (Nomor Induk Pegawai)</label>
                <input type="text" name="nip" value="{{ old('nip', $perangkat->nip) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="PD001234">
                @error('nip')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kontak --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Kontak <span class="text-red-500">*</span></label>
                <input type="text" name="kontak" value="{{ old('kontak', $perangkat->kontak) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="081234567890" required>
                @error('kontak')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                
                {{-- Preview foto saat ini --}}
                @if($perangkat->foto)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <div class="relative inline-block">
                            <img src="{{ Storage::url($perangkat->foto) }}" 
                                 alt="Foto {{ $perangkat->warga->nama }}" 
                                 class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                            <div class="absolute top-2 right-2 bg-black bg-opacity-50 rounded-full p-1">
                                <button type="button" onclick="removePhoto()" class="text-white hover:text-red-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="existing_foto" value="{{ $perangkat->foto }}">
                    </div>
                @endif
                
                {{-- Input upload foto baru --}}
                <div class="mt-2">
                    <input type="file" name="foto" 
                           id="fotoInput"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Maksimal 2MB. Format: JPG, JPEG, PNG</p>
                    <div class="mt-2" id="photoPreview"></div>
                </div>
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Periode Mulai --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Periode Mulai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_mulai" value="{{ old('periode_mulai', $perangkat->periode_mulai->format('Y-m-d')) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('periode_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Periode Selesai --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Periode Selesai</label>
                <input type="date" name="periode_selesai" value="{{ old('periode_selesai', optional($perangkat->periode_selesai)->format('Y-m-d')) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika masih menjabat</p>
                @error('periode_selesai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Saat Ini --}}
            <div class="md:col-span-2">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <span class="font-semibold">Status saat ini:</span> 
                                @php
                                    $now = now();
                                    $selesai = $perangkat->periode_selesai ?: now()->addYear(100);
                                @endphp
                                
                                @if($now->between($perangkat->periode_mulai, $selesai))
                                    <span class="text-green-600 font-bold">Aktif</span> 
                                    (Sejak {{ $perangkat->periode_mulai->format('d F Y') }})
                                @elseif($now->lessThan($perangkat->periode_mulai))
                                    <span class="text-yellow-600 font-bold">Akan Menjabat</span>
                                    (Mulai {{ $perangkat->periode_mulai->format('d F Y') }})
                                @else
                                    <span class="text-red-600 font-bold">Selesai Menjabat</span>
                                    ({{ $perangkat->periode_mulai->format('d F Y') }} - {{ optional($perangkat->periode_selesai)->format('d F Y') }})
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
            <a href="{{ route('perangkat-desa.index') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- Script untuk preview foto dan hapus foto --}}
<script>
    // Preview foto sebelum upload
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const preview = document.getElementById('photoPreview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-32 h-32 object-cover rounded-lg border-2 border-gray-300 mt-2';
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Fungsi untuk hapus foto yang ada
    function removePhoto() {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            // Tambahkan input hidden untuk menandai foto akan dihapus
            let existingInput = document.querySelector('input[name="existing_foto"]');
            if (existingInput) {
                // Ubah name menjadi foto_dihapus agar controller tahu foto lama akan dihapus
                existingInput.name = 'foto_dihapus';
                
                // Sembunyikan preview foto
                existingInput.parentElement.style.display = 'none';
            }
            
            // Tampilkan pesan
            alert('Foto akan dihapus saat data disimpan.');
        }
    }

    // Validasi tanggal
    document.querySelector('input[name="periode_selesai"]').addEventListener('change', function() {
        const mulai = document.querySelector('input[name="periode_mulai"]').value;
        const selesai = this.value;
        
        if (selesai && mulai && selesai < mulai) {
            alert('Tanggal selesai tidak boleh sebelum tanggal mulai!');
            this.value = '';
        }
    });
</script>

<style>
    /* Custom styling untuk form */
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    label {
        transition: all 0.2s ease-in-out;
    }
    
    .required::after {
        content: ' *';
        color: #ef4444;
    }
</style>
@endsection