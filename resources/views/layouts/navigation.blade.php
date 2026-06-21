<nav class="bg-slate-900 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" class="text-2xl font-black text-white">
                    Gestor<span class="text-indigo-400">SSSG</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" 
                       class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }} hover:text-white transition-colors duration-200">
                        Dashboard
                    </a>
                    </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-400 uppercase tracking-wider">
                        {{ Auth::user()->getRoleNames()->first() ?? 'Sin rol' }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="px-5 py-2 rounded-xl bg-slate-800 hover:bg-red-900/50 hover:text-red-400 border border-slate-700 text-slate-300 text-sm font-medium transition-all duration-300">
                            Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>