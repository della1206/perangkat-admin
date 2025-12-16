<div x-data="{ open: false }" class="min-h-screen bg-gray-100 flex flex-col md:flex-row">

    <div class="bg-green-800 text-white flex items-center justify-between p-4 shadow-md md:hidden">
        <div class="flex items-center gap-2">
            <img src="path_ke_logo_anda" class="w-8 h-8" alt="Logo">
            <span class="font-bold tracking-wider">SIPERDES</span>
        </div>
        <button @click="open = !open" class="p-2 rounded-md hover:bg-green-700 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" 
         @click="open = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden">
    </div>

    <aside :class="open ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-green-900 text-white transform transition duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-xl">
        
        <div class="p-6 flex flex-col items-center border-b border-green-700">
            <img src="path_ke_logo_anda" class="w-16 h-16 mb-2" alt="Logo">
            <h2 class="text-lg font-bold">~SIPERDES~</h2>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            @php
                $menus = [
                    ['route' => 'dashboard.index', 'icon' => '🏠', 'label' => 'Dashboard', 'active' => 'dashboard.*'],
                    ['route' => 'user.index', 'icon' => '👩🏻‍🦰', 'label' => 'User', 'active' => 'user.*'],
                    ['route' => 'warga.index', 'icon' => '👨‍👩‍👧‍👦', 'label' => 'Warga', 'active' => 'warga.*'],
                    ['route' => 'jabatan.index', 'icon' => '📊', 'label' => 'Jabatan Desa', 'active' => 'jabatan.*'],
                ];
            @endphp

            @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs($menu['active']) ? 'bg-green-700 shadow-inner' : 'hover:bg-green-800' }}">
                    <span class="text-xl">{{ $menu['icon'] }}</span>
                    <span class="font-medium">{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-green-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition shadow">
                    🚪 <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="hidden md:flex items-center justify-between bg-white px-8 py-4 shadow-sm">
            <h1 class="text-xl font-semibold text-gray-700">Data Warga</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 italic">Halo, Admin</span>
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">SA</div>
            </div>
        </header>

        <div class="p-4 md:p-8">
            @yield('content')
        </div>
    </main>
</div>