@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pengguna</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap pengguna sistem</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('user.index') }}" 
                       class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    
                    @if(in_array(auth()->user()->role, ['super_admin', 'admin']) && (auth()->user()->role === 'super_admin' || $user->role !== 'super_admin'))
                    <a href="{{ route('user.edit', $user->id) }}"
                       class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit User
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Profil -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Foto Profil -->
                    <div class="shrink-0">
                        <img src="{{ $user->photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="h-40 w-40 object-cover rounded-full border-4 border-white shadow-lg">
                    </div>

                    <!-- Informasi Utama -->
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                        
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                            @if($user->role == 'super_admin')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Super Admin
                            </span>
                            @elseif($user->role == 'admin')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Admin
                            </span>
                            @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                Warga
                            </span>
                            @endif

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Bergabung: {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <p class="text-gray-600">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Detail Informasi -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Informasi Personal -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                Informasi Personal
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Email</p>
                                    <p class="font-medium text-gray-800">{{ $user->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Role</p>
                                    <p class="font-medium">
                                        @if($user->role == 'super_admin')
                                        <span class="text-purple-600">Super Administrator</span>
                                        @elseif($user->role == 'admin')
                                        <span class="text-blue-600">Administrator</span>
                                        @else
                                        <span class="text-green-600">Warga</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Akun -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Informasi Akun
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">ID Pengguna</p>
                                    <p class="font-mono text-gray-800 bg-gray-50 p-2 rounded">{{ $user->id }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Tanggal Bergabung</p>
                                    <p class="font-medium text-gray-800">
                                        {{ $user->created_at->format('d F Y H:i') }}
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Terakhir Diperbarui</p>
                                    <p class="font-medium text-gray-800">
                                        {{ $user->updated_at->format('d F Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terakhir -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Ringkasan Aktivitas
                    </h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-600">
                            @if($user->role == 'super_admin')
                            Pengguna ini memiliki akses penuh ke semua fitur sistem sebagai <span class="font-semibold text-purple-600">Super Administrator</span>.
                            @elseif($user->role == 'admin')
                            Pengguna ini dapat mengelola data warga dan konten sebagai <span class="font-semibold text-blue-600">Administrator</span>.
                            @else
                            Pengguna ini adalah <span class="font-semibold text-green-600">Warga</span> dengan akses terbatas sesuai peran.
                            @endif
                        </p>
                        
                        @if($user->id == auth()->id())
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-700">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                Ini adalah akun Anda sendiri. Anda dapat mengubah profil melalui menu profile.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                @if(in_array(auth()->user()->role, ['super_admin', 'admin']))
                <div class="mt-8 pt-8 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('user.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                        Kembali ke Daftar
                    </a>
                    
                    @if(auth()->user()->role === 'super_admin' || $user->role !== 'super_admin')
                    <a href="{{ route('user.edit', $user->id) }}"
                       class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Edit Pengguna
                    </a>
                    @endif
                    
                    @if($user->id != auth()->id() && (auth()->user()->role === 'super_admin' || (auth()->user()->role === 'admin' && $user->role !== 'super_admin')))
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                            Hapus Pengguna
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection