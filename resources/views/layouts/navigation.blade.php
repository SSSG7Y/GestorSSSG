<nav x-data="{ open: false, dropOpen: false }" class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex items-center gap-3">
                <button @click="open = !open" class="md:hidden p-2 rounded-lg bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 transition-all border border-slate-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <a href="{{ route('dashboard') }}" class="text-xl sm:text-2xl font-black text-white">
                    Gestor<span class="text-indigo-400">SSSG</span>
                </a>
            </div>

            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }} hover:text-white transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.index') ? 'text-white' : 'text-slate-400' }} hover:text-white transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    Proyectos
                </a>
                <div class="relative">
                    <button @click="dropOpen = !dropOpen" class="{{ request()->routeIs('projects.tasks.*') ? 'text-white' : 'text-slate-400' }} hover:text-white transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Tareas ▾
                    </button>
                    <div x-show="dropOpen" @click.away="dropOpen = false" class="absolute mt-2 w-56 bg-slate-800 rounded-xl border border-slate-700 shadow-2xl z-50">
                        @foreach($proyectosNavegacion ?? [] as $p)
                            <a href="{{ route('projects.tasks.index', $p->id) }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-slate-700 hover:text-white border-b border-slate-700 last:border-0">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span> {{ $p->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-indigo-400 uppercase tracking-widest">{{ Auth::user()->getRoleNames()->first() ?? 'Sin rol' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="px-5 py-2 rounded-xl bg-slate-800 hover:bg-red-900/50 hover:text-red-400 border border-slate-700 text-slate-300 text-sm font-medium transition-all duration-500">

                        Cerrar sesión

                    </button>

                </form>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200" class="md:hidden bg-slate-900 border-t border-slate-800 p-4 space-y-3">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-slate-300 py-3 px-4 rounded-lg hover:bg-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('projects.index') }}" class="flex items-center gap-3 text-slate-300 py-3 px-4 rounded-lg hover:bg-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
            Proyectos
        </a>
        <div class="mt-4 pt-4 border-t border-slate-800">
            <p class="text-indigo-400 text-[12px] font-black uppercase tracking-widest px-4 mb-2">Tareas</p>
            <p class="text-slate-400 text-[10px] font-medium uppercase tracking-widest px-4 mb-2">Escoja un proyecto</p>
            @foreach($proyectosNavegacion ?? [] as $p)
                <a href="{{ route('projects.tasks.index', $p->id) }}" class="flex items-center gap-3 text-slate-400 py-2.5 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> {{ $p->nombre }}
                </a>
            @endforeach
        </div>
    </div>
</nav>