<div class="space-y-4">
    @forelse($tasks as $task)
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-indigo-500/50 transition-all">
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <h4 class="text-xl font-bold text-white">{{ $task->titulo }}</h4>
                <p class="text-slate-400 mt-2 text-sm">{{ $task->descripcion ?: 'Sin descripción' }}</p>
                <div class="flex gap-4 mt-4 text-xs">
                    <span class="text-indigo-400 font-medium">Límite: {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'N/A' }}</span>
                    <span class="text-slate-500">Prioridad: {{ ucfirst($task->prioridad) }}</span>
                </div>
            </div>
            
            <div class="flex flex-col items-end gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold 
                    {{ $task->estado == 'completada' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                    {{ ucfirst(str_replace('_', ' ', $task->estado)) }}
                </span>
                
                <div class="flex gap-3">
                    @can('update', $task)
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-slate-400 hover:text-white text-sm">Editar</a>
                    @endcan
                    @can('delete', $task)
                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" id="del-{{ $task->id }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="if(confirm('¿Eliminar?')) document.getElementById('del-{{ $task->id }}').submit();" class="text-red-400 hover:text-red-300 text-sm">Eliminar</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @empty
        <p class="text-slate-500 text-center py-10">No hay tareas en este proyecto.</p>
    @endforelse
</div>