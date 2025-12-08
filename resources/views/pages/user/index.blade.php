@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header dengan Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar User</h1>
            <p class="text-gray-600 mt-1">Kelola data pengguna sistem</p>
        </div>
        
        <!-- PERIKSA: Hanya superadmin dan admin yang bisa tambah user -->
        @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
        <a href="{{ route('user.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah User
        </a>
        @endif
    </div>

    <!-- Filter dan Search -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('user.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Filter Role -->
            <select name="role" class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Role</option>
                <option value="superadmin" {{ request('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="warga" {{ request('role') == 'warga' ? 'selected' : '' }}>Warga</option>
            </select>
            
            <!-- Search -->
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau email..." 
                   class="border rounded-lg p-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Cari
                </button>
                
                @if(request('search') || request('role'))
                <a href="{{ route('user.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel User -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EMAIL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ROLE</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition">
                        <!-- Nomor dengan pagination offset -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->role == 'superadmin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                Super Admin
                            </span>
                            @elseif($user->role == 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Admin
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Warga
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <!-- PERIKSA: Hanya superadmin dan admin yang bisa edit/hapus -->
                            @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
                            <div class="flex justify-center space-x-2">
                                <!-- Tombol Edit -->
                                @if(auth()->user()->role === 'superadmin' || $user->role !== 'superadmin')
                                <a href="{{ route('user.edit', $user->id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    Edit
                                </a>
                                @endif
                                
                                <!-- Tombol Hapus -->
                                @if($user->id != auth()->id() && (auth()->user()->role === 'superadmin' || (auth()->user()->role === 'admin' && $user->role !== 'superadmin')))
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                            @else
                            <div class="text-center text-gray-500 text-sm italic">
                                Hanya baca
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- PAGINATION SECTION -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                <!-- Info jumlah data -->
                <div class="text-sm text-gray-700">
                    Menampilkan 
                    <span class="font-medium">{{ $users->firstItem() }}</span> 
                    sampai 
                    <span class="font-medium">{{ $users->lastItem() }}</span> 
                    dari 
                    <span class="font-medium">{{ $users->total() }}</span> 
                    data
                </div>
                
                <!-- Navigasi halaman -->
                <div class="flex items-center space-x-1">
                    <!-- Tombol Previous -->
                    @if($users->onFirstPage())
                        <span class="px-3 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            &laquo; Prev
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}{{ request('role') ? '&role=' . request('role') : '' }}{{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100 transition">
                            &laquo; Prev
                        </a>
                    @endif
                    
                    <!-- Tombol Next -->
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}{{ request('role') ? '&role=' . request('role') : '' }}{{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100 transition">
                            Next &raquo;
                        </a>
                    @else
                        <span class="px-3 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">
                            Next &raquo;
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        @else
        <!-- Empty state -->
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada data user</h3>
            <p class="mt-1 text-gray-500">
                @if(request('search') || request('role'))
                    Coba ubah filter pencarian Anda atau
                    <a href="{{ route('user.index') }}" class="text-blue-600 hover:text-blue-800">reset filter</a>
                @else
                    Belum ada data user. 
                    @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
                        <a href="{{ route('user.create') }}" class="text-blue-600 hover:text-blue-800">Tambahkan user baru</a>
                    @endif
                @endif
            </p>
        </div>
        @endif
    </div>
</div>
@endsection