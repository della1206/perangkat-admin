<ul class="space-y-3">
    <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('dashboard.*') ? 'bg-dark green-700' : '' }}">🏠 Dashboard</a></li>
    <li><a href="{{ route('user.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('user.*') ? 'bg-dark green-700' : '' }}">👩🏻‍🦰 User</a></li>
    <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('warga.*') ? 'bg-dark green-700' : '' }}">👨‍👩‍👧‍👦 Warga</a></li>
    <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-green-700 {{ request()->routeIs('warga.*') ? 'bg-dark green-700' : '' }}">👨‍👩‍👧‍👦 Warga</a></li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('jabatan.index') }}">
        <i class="bi bi-briefcase"></i> Jabatan Lembaga
    </a>
</li>
    
    <!-- Tambahkan ini -->
    <li class="p-2">
    <a href="{{ route('jabatan.index') }}" 
       class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-green-700 
             {{ request()->routeIs('jabatan.*') ? 'bg-green-700 text-white' : 'text-white' }}">
        📊 <span>Jabatan Desa</span>
    </a>
</li>
</ul>
