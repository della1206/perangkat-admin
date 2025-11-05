<!-- Sidebar -->
<aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="p-4 text-2xl font-bold border-b border-gray-700">
        Perangkat Desa
    </div>

    <nav class="flex-1 p-4">
        <ul class="space-y-3">
            <li><a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-gray-700">🏠 Dashboard</a></li>
            <li><a href="{{ route('user.index') }}" class="block p-2 rounded hover:bg-gray-700">👩🏻‍🦰 User</a></li>
            <li><a href="{{ route('warga.index') }}" class="block p-2 rounded hover:bg-gray-700">👨‍👩‍👧‍👦 Warga</a></li>
            <li><a href="{{ route('lembaga.index') }}" class="block p-2 rounded hover:bg-gray-700">🏢 Lembaga Desa</a></li>
        </ul>
    </nav>

    <div class="p-4 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full p-2 bg-red-600 rounded text-center hover:bg-red-700">Keluar</button>
        </form>
    </div>
</aside>