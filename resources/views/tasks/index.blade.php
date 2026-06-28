<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white p-4 md:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between md:items-center mb-8 gap-4">
                <h1 class="text-3xl md:text-4xl font-black">Tareas de: <span class="text-indigo-400">{{ $project->nombre }}</span></h1>
                @can('create', [App\Models\Task::class, $project])
                    <a href="{{ route('projects.tasks.create', $project) }}" class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all font-semibold text-center">
                        + Nueva Tarea
                    </a>
                @endcan
            </div>

            <form method="GET" action="{{ route('projects.tasks.index', $project) }}" 
                class="mb-8 grid grid-cols-1 md:grid-cols-12 gap-4 items-end bg-slate-900/50 p-6 rounded-3xl border border-slate-800 shadow-lg">
                <div class="md:col-span-6">
                    <label class="block text-xs text-slate-400 uppercase font-bold mb-2 tracking-wider">Buscar tarea</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="bg-slate-950 border border-slate-700 rounded-2xl w-full p-3 text-sm text-white focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Escribe el título...">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs text-slate-400 uppercase font-bold mb-2 tracking-wider">Prioridad</label>
                    <select name="prioridad" class="bg-slate-950 border border-slate-700 rounded-2xl w-full p-3 text-sm text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                        <option value="">Todas</option>
                        <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                        <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 p-3 rounded-2xl text-sm font-bold transition-all text-white">Filtrar</button>
                    <a href="{{ route('projects.tasks.index', $project) }}" class="flex-1 bg-slate-800 hover:bg-slate-700 p-3 rounded-2xl text-sm text-center text-slate-300 transition-all">Limpiar</a>
                </div>
            </form>

            <div class="space-y-6">
                @forelse($tasks as $task)
                    <div class="bg-slate-900/70 border border-slate-800 rounded-3xl p-6 shadow-2xl min-w-0">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                            
                            <div class="space-y-2 min-w-0">
                                <h2 class="font-bold text-xl truncate" title="{{ $task->titulo }}">{{ $task->titulo }}</h2>
                                <p class="text-xs text-slate-400 flex items-center gap-2">
                                    Encargado: 
                                    <span class="bg-indigo-900/50 text-indigo-300 px-2 py-0.5 rounded-full truncate">
                                        {{ $task->user->name ?? 'Sin asignar' }}
                                    </span>
                                </p>
                                <p class="text-sm text-slate-400 truncate">{{ $task->descripcion }}</p>
                            </div>
                            
                            <div class="flex flex-row md:flex-col items-center md:items-start gap-2 md:gap-1">
                                <span class="text-[10px] text-slate-500 uppercase">Prioridad</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $task->prioridad == 'alta' ? 'bg-red-500/20 text-red-400' : 'bg-blue-500/20 text-blue-400' }}">
                                    {{ $task->prioridad }}
                                </span>
                            </div>

                            <div class="flex flex-row md:flex-col items-center md:items-start gap-2 md:gap-1">
                                <span class="text-[10px] text-slate-500 uppercase">Estado</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ match(strtolower($task->estado)) {
                                    'completada', 'completado' => 'bg-green-500/20 text-green-400',
                                    'en progreso', 'en_progreso' => 'bg-blue-500/20 text-blue-400',
                                    'pendiente' => 'bg-yellow-500/20 text-yellow-400',
                                    default => 'bg-slate-800 text-slate-300'
                                } }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->estado)) }}
                                </span>
                            </div>

                            <div class="flex flex-row items-center justify-start md:justify-end gap-2">
                                @can('update', $task) <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-xs font-bold">Editar</a> @endcan
                                @can('assign', $task) <a href="{{ route('projects.tasks.assign.form', [$project, $task]) }}" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 rounded-lg text-xs font-bold">Asignar</a> @endcan
                                @can('delete', $task)
                                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('¿Seguro?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-xs font-bold">Eliminar</button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <div x-data="{ expanded: false }" class="mt-6 pt-6 border-t border-slate-800">
                            @php
                                $sortedComments = $task->comments->sortBy('created_at')->values();
                                $totalComments = $sortedComments->count();
                            @endphp
                            
                            <div class="flex justify-between items-center mb-4">
                                <p class="text-[10px] text-slate-400 uppercase font-bold">Comentarios ({{ $totalComments }})</p>
                                @if($totalComments > 5)
                                    <button @click="expanded = !expanded" class="text-[10px] text-indigo-400 font-bold uppercase" x-text="expanded ? 'Ver menos' : 'Ver más'"></button>
                                @endif
                            </div>
                            
                            <div class="space-y-2 mb-4">
                                @foreach($sortedComments as $index => $comment)
                                    <div x-show="expanded || {{ $index }} >= ({{ $totalComments }} - 5)" 
                                         class="flex justify-between items-center text-xs bg-slate-950 p-2 rounded-lg break-words group">
                                        <p class="break-words w-full"><span class="text-indigo-400 font-bold">{{ $comment->user->name ?? 'User' }}:</span> {{ $comment->cuerpo }}</p>
                                        
                                        @can('delete', $comment)
                                            <div x-data="{ openMenu: false }" class="relative ml-2">
                                                <button @click="openMenu = !openMenu" class="text-slate-500 hover:text-white font-bold p-1">
                                                    &bull;&bull;&bull;
                                                </button>
                                                <div x-show="openMenu" @click.away="openMenu = false" class="absolute right-0 mt-2 w-28 bg-slate-800 border border-slate-700 rounded-lg shadow-xl z-50 text-xs">
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('¿Seguro?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="w-full text-left px-3 py-2 text-red-400 hover:bg-slate-700 rounded-t-lg">Eliminar</button>
                                                    </form>
                                                    <button @click="openMenu = false" class="w-full text-left px-3 py-2 text-slate-300 hover:bg-slate-700 rounded-b-lg">Cancelar</button>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                @endforeach
                            </div>
                            
                            @can('create', [App\Models\Comment::class, $task])
                                <form action="{{ route('comments.store', [$project, $task]) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <input type="text" name="cuerpo" placeholder="Añadir comentario..." required class="bg-slate-950 border border-slate-700 rounded-xl w-full p-2 text-xs">
                                    <button type="submit" class="text-indigo-500 font-bold text-xs hover:text-indigo-400 px-2">Enviar</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-500 bg-slate-900/50 rounded-3xl">No hay tareas encontradas.</div>
                @endforelse
            </div>
            <div class="mt-6">{{ $tasks->appends(request()->query())->links() }}</div>
        </div>
    </div>
</x-app-layout>