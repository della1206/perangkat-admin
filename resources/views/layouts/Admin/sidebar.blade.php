<div x-data="{ open: false }" class="min-h-screen bg-gray-100 flex overflow-x-hidden relative">

    <aside 
        :class="open ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed inset-y-0 left-0 z-50 w-64 bg-green-900 text-white transform transition duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-2xl">
        
        <div class="p-6 flex flex-col items-center border-b border-green-700">
            <h2 class="text-lg font-bold tracking-widest">~SIPERDES~</h2>
            <button @click="open = false" class="md:hidden absolute top-4 right-4 text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs($menu['active']) ? 'bg-green-700' : 'hover:bg-green-800' }}">
                    <span>{{ $menu['icon'] }}</span>
                    <span class="text-sm font-medium">{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-green-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition">
                    🚪 <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 min-w-0 w-full flex flex-col bg-gray-100">
        
        <header class="bg-white flex items-center justify-between p-4 shadow-sm md:hidden sticky top-0 z-30">
            <button @click="open = !open" class="p-2 bg-green-800 text-white rounded-md focus:outline-none shadow-md">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-[10px] font-bold">DE</div>
                <span class="text-xs font-bold text-gray-700">Hi, dell</span>
            </div>
        </header>

                    <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                @yield('content')
            </div>
        </div>
    </main>

    <div x-show="open" 
         x-cloak
         @click="open = false" 
         class="fixed inset-0 bg-black/50 z-40 md:hidden transition-opacity">
    </div>

</div>