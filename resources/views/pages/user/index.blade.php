@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">👥 Data User</h1>
            <p class="text-gray-600 mt-1">Kelola data pengguna sistem</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('user.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter dan Search Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('user.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari nama atau email..." 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute left-3 top-2.5">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Filter Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Role</option>
                        <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end space-x-3">
                    @if(request()->anyFilled(['search', 'role']))
                    <a href="{{ route('user.index') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center transition h-10">
                        <i class="fas fa-redo mr-2"></i> Reset
                    </a>
                    @endif
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition shadow-sm h-10">
                        <i class="fas fa-filter mr-2"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Table Header Info -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <div>
                <span class="text-sm text-gray-600">
                    Total: <span class="font-semibold">{{ $users->total() }}</span> data user
                </span>
            </div>
            <div>
                @if(request()->anyFilled(['search', 'role']))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fas fa-filter mr-1"></i> Filter Aktif
                </span>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($user->role == 'Super Admin') bg-red-100 text-red-800
                                @elseif($user->role == 'Admin') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('user.edit', $user->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded text-sm transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded text-sm transition">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                                <p class="text-lg font-medium">Tidak ada data user</p>
                                <p class="text-sm mt-1">
                                    @if(request()->anyFilled(['search', 'role']))
                                        User tidak ditemukan dengan filter yang dipilih
                                    @else
                                        Mulai dengan menambahkan user baru
                                    @endif
                                </p>
                                @if(request()->anyFilled(['search', 'role']))
                                <a href="{{ route('user.index') }}" class="mt-3 inline-block text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-redo mr-1"></i> Reset filter
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Showing Results -->
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-gray-700">
                        Showing 
                        <span class="font-medium">{{ $users->firstItem() }}</span> 
                        to 
                        <span class="font-medium">{{ $users->lastItem() }}</span> 
                        of 
                        <span class="font-medium">{{ $users->total() }}</span> 
                        results
                    </p>
                </div>

                <!-- Pagination Links -->
                <div>
                    <div class="flex items-center space-x-2">
                        <!-- Previous Button -->
                        @if($users->onFirstPage())
                            <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                                &laquo; Previous
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
                                &laquo; Previous
                            </a>
                        @endif
                        
                        <!-- Page Numbers -->
                        <div class="flex items-center space-x-1">
                            @php
                                $currentPage = $users->currentPage();
                                $lastPage = $users->lastPage();
                                
                                // Tentukan rentang halaman yang ditampilkan
                                $start = max(1, $currentPage - 4);
                                $end = min($lastPage, $currentPage + 5);
                                
                                // Jika terlalu dekat dengan awal, geser ke kanan
                                if ($currentPage <= 5) {
                                    $end = min(10, $lastPage);
                                }
                                
                                // Jika terlalu dekat dengan akhir, geser ke kiri
                                if ($currentPage >= $lastPage - 4) {
                                    $start = max(1, $lastPage - 9);
                                }
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $users->url(1) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                    1
                                </a>
                                @if($start > 2)
                                    <span class="px-2 text-gray-500">...</span>
                                @endif
                            @endif
                            
                            @for($page = $start; $page <= $end; $page++)
                                @if($page == $currentPage)
                                    <span class="px-3 py-1 bg-blue-600 text-white rounded">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $users->url($page) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor
                            
                            @if($end < $lastPage)
                                @if($end < $lastPage - 1)
                                    <span class="px-2 text-gray-500">...</span>
                                @endif
                                <a href="{{ $users->url($lastPage) }}" class="px-3 py-1 text-blue-600 hover:text-blue-800 rounded">
                                    {{ $lastPage }}
                                </a>
                            @endif
                        </div>
                        
                        <!-- Next Button -->
                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">
                                Next &raquo;
                            </a>
                        @else
                            <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                                Next &raquo;
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clear search button functionality
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            const form = searchInput.closest('form');
            const clearBtn = document.createElement('button');
            clearBtn.type = 'button';
            clearBtn.className = 'absolute right-10 top-2.5 text-gray-400 hover:text-gray-600';
            clearBtn.innerHTML = '<i class="fas fa-times"></i>';
            clearBtn.style.display = searchInput.value ? 'block' : 'none';
            
            searchInput.parentNode.appendChild(clearBtn);

            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                this.style.display = 'none';
                form.submit();
            });

            searchInput.addEventListener('input', function() {
                clearBtn.style.display = this.value ? 'block' : 'none';
            });
        }
    });
</script>
@endsection