@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Edit Data User</h1>
            <p class="text-gray-600 mt-1">Perbarui data pengguna sistem</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">Terjadi kesalahan!</span>
                </div>
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Profil
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="photoPreview" 
                                    class="h-32 w-32 object-cover rounded-full border-2 border-gray-300"
                                    src="{{ $user->photo_url }}"
                                    alt="Preview foto profil">
                            </div>
                            <div class="flex-1">
                                <label class="block">
                                    <input type="file" 
                                            name="photo" 
                                            id="photoInput"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                            accept="image/*"
                                            onchange="previewPhoto(event)">
                                    <p class="mt-1 text-xs text-gray-500">
                                        PNG, JPG, atau JPEG (maks. 2MB)
                                    </p>
                                    @if($user->photo)
                                    <p class="mt-2 text-xs text-gray-500">
                                        Foto saat ini: {{ $user->photo }}
                                    </p>
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Masukkan nama lengkap"
                                required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="contoh@email.com"
                                required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="role" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                            <option value="">Pilih Role</option>
                            <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password (Biarkan kosong jika tidak ingin mengubah)
                        </label>
                        <input type="password" 
                                name="password"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Minimal 8 karakter">
                        <p class="mt-1 text-xs text-gray-500">
                            Kosongkan jika tidak ingin mengubah password
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password" 
                                name="password_confirmation"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Ulangi password jika ingin mengubah">
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('user.index') }}" 
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('photoPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection