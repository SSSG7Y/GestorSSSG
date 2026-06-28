<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-black text-white">
                Mis Proyectos
            </h2>

            @can('create', App\Models\Project::class)
                <a href="{{ route('projects.create') }}"
                   class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/30 transition-all duration-300">
                    + Nuevo Proyecto
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <form method="GET" action="{{ route('projects.index') }}" class="mb-8 flex flex-col sm:flex-row gap-4 items-center">
    <div class="relative w-full flex-grow">
        <input
            type="text"
            id="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar proyecto..."
            class="w-full bg-slate-900 border border-slate-800 rounded-2xl pl-14 pr-14 py-4 text-white placeholder-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-none transition-all"
        >
        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <div class="flex items-center gap-4 w-full sm:w-auto flex-shrink-0">
        <select name="estado" onchange="this.form.submit()" class="w-full sm:w-auto bg-slate-900 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 border-none transition-all cursor-pointer">
            <option value="">Todos los estados</option>
            <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="pausado" {{ request('estado') == 'pausado' ? 'selected' : '' }}>Pausado</option>
            <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
        </select>

        @if(request('search') || request('estado'))
            <a href="{{ route('projects.index') }}" class="px-6 py-4 rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-semibold transition-all">
                ×
            </a>
        @endif
    </div>
</form>

            @if($projects->count())
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl hover:border-indigo-500/40 hover:scale-[1.01] transition-all duration-300">
                            <div class="flex items-start justify-between mb-5">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">
                                        {{ $project->nombre }}
                                    </h3>
                                    <p class="text-slate-400 mt-3 leading-relaxed line-clamp-3">
                                        {{ $project->descripcion ?: 'Sin descripción disponible.' }}
                                    </p>
                                </div>
                                <div>
                                    @if($project->estado === 'activo')
                                        <span class="px-3 py-1 rounded-full text-xs bg-emerald-500/20 text-emerald-400 border border-emerald-500/20">
                                            Activo
                                        </span>
                                    @elseif($project->estado === 'pausado')
                                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400 border border-yellow-500/20">
                                            Pausado
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400 border border-red-500/20">
                                            Finalizado
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-slate-950 border border-slate-800 rounded-2xl p-4">
                                    <p class="text-slate-500 text-sm">
                                        Propietario
                                    </p>
                                    <h4 class="text-white font-semibold mt-1">
                                        {{ $project->owner->name ?? 'N/A' }}
                                    </h4>
                                </div>
                                <div class="bg-slate-950 border border-slate-800 rounded-2xl p-4">
                                    <p class="text-slate-500 text-sm">
                                        Tareas
                                    </p>
                                    <h4 class="text-white font-semibold mt-1">
                                        {{ $project->tasks->count() }}
                                    </h4>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 flex-wrap">
                                <a href="{{ route('projects.show', $project) }}"
                                   class="text-cyan-400 hover:text-cyan-300 font-semibold transition-all">
                                    Ver
                                </a>
                                @can('update', $project)
                                    <a href="{{ route('projects.edit', $project) }}"
                                       class="text-indigo-400 hover:text-indigo-300 font-semibold transition-all">
                                        Editar
                                    </a>
                                @endcan
                                @can('delete', $project)
                                    <form action="{{ route('projects.destroy', $project) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este proyecto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-400 hover:text-red-300 font-semibold transition-all">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-16 text-center shadow-2xl">
                    <div class="text-6xl mb-6">
                        📁
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">
                        No hay proyectos
                    </h3>
                    <p class="text-slate-400 text-lg mb-8">
                        Crea tu primer proyecto para comenzar a trabajar.
                    </p>
                    @can('create', App\Models\Project::class)
                        <a href="{{ route('projects.create') }}"
                           class="inline-flex px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/30 transition-all duration-300">
                            Crear Proyecto
                        </a>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</x-app-layout>