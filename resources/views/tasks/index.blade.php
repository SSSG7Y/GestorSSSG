<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-black">Tareas de: <span class="text-indigo-400">{{ $project->nombre }}</span></h1>
                @can('create', [App\Models\Task::class, $project])
                    <a href="{{ route('projects.tasks.create', $project) }}" class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all text-white font-semibold">
                        + Nueva Tarea
                    </a>
                @endcan
            </div>

            <div class="bg-slate-900/70 border border-slate-800 rounded-3xl p-6 shadow-2xl">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-800">
                            <th class="pb-4 px-4">Información y Colaboración</th>
                            <th class="pb-4 px-4">Estado</th>
                            <th class="pb-4 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr class="border-b border-slate-800 hover:bg-slate-800/50">
                            <td class="py-4 px-4">
                                <div class="font-bold text-lg">{{ $task->titulo }}</div>
                                <div class="text-xs text-slate-400 mb-2">{{ Str::limit($task->descripcion, 50) }}</div>
                                
                                <div class="mt-2 p-2 bg-slate-800/50 rounded-lg max-h-32 overflow-y-auto">
                                    @forelse($task->comments as $comment)
                                        <div class="mb-1 border-b border-slate-700/50 pb-1 flex justify-between items-center">
                                            <p class="text-[11px] text-slate-300">
                                                <span class="font-bold text-indigo-400">{{ $comment->user->name ?? 'Usuario' }}:</span> 
                                                {{ $comment->cuerpo }}
                                            </p>
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('¿Eliminar comentario?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-300 ml-2 font-bold text-[10px]">X</button>
                                                </form>
                                            @endcan
                                        </div>
                                    @empty
                                        <p class="text-[10px] text-slate-500 italic">Sin comentarios.</p>
                                    @endforelse
                                </div>
                                
                                @can('create', [App\Models\Comment::class, $task])
                                    <form action="{{ route('comments.store', [$project, $task]) }}" method="POST" class="mt-2 flex gap-2">
                                        @csrf
                                        <input type="text" name="cuerpo" placeholder="Añadir comentario..." required class="bg-slate-800 text-xs rounded-lg w-full p-2 border-none focus:ring-1 focus:ring-indigo-500">
                                        <button type="submit" class="text-indigo-500 font-bold text-xs hover:text-indigo-400">Enviar</button>
                                    </form>
                                @endcan
                            </td>

                            <td class="py-4 px-4">
                                <form action="{{ route('projects.tasks.status', [$project, $task]) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ $task->estado == 'completada' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->estado)) }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-4 text-right flex gap-2 justify-end">
                                @can('update', $task)
                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-indigo-400 text-sm hover:text-indigo-300">Editar</a>
                                @endcan
                                
                                @can('delete', $task)
                                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:text-red-400">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-10 text-center text-slate-500">No hay tareas registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>