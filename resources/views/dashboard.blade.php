<x-app-layout>
    <div class="py-10 bg-slate-950 ">
        <div class="max-w-7xl mx-auto px-6">
            
            <header class="flex flex-col gap-6 mb-10">
                <div>
                    <h2 class="text-4xl font-black text-white">Hola, {{ auth()->user()->name }}</h2>
                    <p class="text-slate-400">Panel de control de proyectos «GestorSSSG»</p>
                </div>

                
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                @foreach([['Proyectos', $totalProyectos], ['Tareas', $totalTareas], ['Usuarios', $totalUsuarios], ['Comentarios', $totalComentarios]] as $stat)
                    <div class="bg-slate-900 border border-slate-800 p-6 rounded-3xl">
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">{{ $stat[0] }}</p>
                        <div class="text-4xl font-black text-white mt-2">{{ $stat[1] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-slate-900 border border-slate-800 rounded-3xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">
                        {{ auth()->user()->hasRole(['admin', 'líder']) ? 'Todos los Proyectos' : 'Mis Proyectos' }}
                    </h3>
                    <div class="space-y-4">
                        @forelse($proyectosRecientes as $proyecto)
                            <div class="flex items-center justify-between p-4 bg-slate-950 rounded-2xl border border-slate-800 hover:border-indigo-500 transition-all">
                                <div>
                                    <h4 class="text-white font-semibold">{{ $proyecto->nombre }}</h4>
                                    <p class="text-xs text-slate-500">Creado {{ $proyecto->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400 font-bold">{{ $proyecto->estado }}</span>
                                    <a href="{{ route('projects.show', $proyecto->id) }}" class="text-xs text-indigo-400 font-bold hover:text-white transition">Ver</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500 italic">No tienes proyectos asignados.</p>
                        @endforelse
                    </div>
                </div>

                <aside class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-6">Mis Tareas Pendientes</h3>
                    <div class="space-y-4">
                        @forelse($tareasRecientes as $tarea)
                            <div class="flex items-center justify-between p-3 bg-slate-950 rounded-xl border border-slate-800 hover:border-slate-700 transition">
                                <span class="text-sm text-slate-300 truncate w-40">{{ $tarea->titulo }}</span>
                                <a href="{{ route('projects.tasks.index', $tarea->project_id) }}" 
                                    class="text-xs text-indigo-400 font-bold hover:text-white transition">
                                    Revisar
                                </a>
                            </div>
                        @empty
                            <p class="text-slate-500 text-sm">¡Estás al día!</p>
                        @endforelse
                    </div>
                </aside>
            </div>
        </div>
    </div>
    
</div>
</x-app-layout>