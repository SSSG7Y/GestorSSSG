<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-black text-white">{{ $project->titulo }}</h2>
                <p class="text-slate-400 mt-2">{{ $project->descripcion }}</p>
            </div>
            @can('update', $project)
                <a href="{{ route('projects.tasks.create', $project) }}" class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/30 text-white font-semibold">
                    + Nueva Tarea
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                        <p class="text-slate-400 text-sm">Total Tareas</p>
                        <h3 class="text-4xl font-black text-white mt-2">{{ $project->tasks->count() }}</h3>
                    </div>
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                        <p class="text-slate-400 text-sm">Completadas</p>
                        <h3 class="text-4xl font-black text-emerald-400 mt-2">{{ $project->tasks->where('estado', 'completada')->count() }}</h3>
                    </div>
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                        <p class="text-slate-400 text-sm">Pendientes</p>
                        <h3 class="text-4xl font-black text-yellow-400 mt-2">{{ $project->tasks->where('estado', 'pendiente')->count() }}</h3>
                    </div>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-bold text-white">Tareas de Alta Prioridad</h3>
                        <a href="{{ route('projects.tasks.index', $project) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold text-sm">Ver todas →</a>
                    </div>
                    
                    @php $highTasks = $project->tasks->where('prioridad', 'alta'); @endphp
                    @if($highTasks->count() > 0)
                        <div class="space-y-4">
                            @foreach($highTasks->take(5) as $task)
                                <div class="bg-slate-950 border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                                    <div>
                                        <h4 class="font-bold text-white">{{ $task->titulo }}</h4>
                                        <p class="text-xs text-slate-500 mt-1">Límite: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Sin definir' }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-400 border border-red-500/20">Alta</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-slate-500 py-4">No hay tareas de alta prioridad.</p>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Equipo del Proyecto</h3>
                    <ul class="space-y-4 mb-6">
                        @foreach($project->members as $member)
                            <li class="flex justify-between items-center text-sm text-slate-300 bg-slate-800/50 p-2 rounded-lg">
                                <span>{{ $member->name }} <br><span class="text-indigo-400 text-[10px] uppercase font-bold">{{ $member->pivot->project_role }}</span></span>
                                @can('update', $project)
                                    <form action="{{ route('members.destroy', [$project, $member]) }}" method="POST" onsubmit="return confirm('¿Eliminar del equipo?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400 px-2 font-bold">✕</button>
                                    </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                    @can('update', $project)
                        <hr class="border-slate-800 my-4">
                        <h4 class="text-sm font-semibold text-slate-400 mb-4">Agregar nuevo miembro</h4>
                        <form action="{{ route('members.store', $project) }}" method="POST" class="space-y-4">
                            @csrf
                            <select name="user_id" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white text-sm">
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <select name="role" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white text-sm">
                                <option value="lider">Líder</option>
                                <option value="colaborador">Colaborador</option>
                            </select>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg p-2 text-sm font-bold transition-all">Asignar</button>
                        </form>
                    @endcan
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Actividad</h3>
                    <ul class="space-y-4 text-sm text-slate-400">
                        @forelse($project->activities as $activity)
                            <li>
                                <span class="text-white font-semibold">{{ $activity->user->name }}</span> 
                                {{ str_replace(['created ', 'updated '], ['creó ', 'actualizó '], $activity->description) }}
                                <br><span class="text-[10px] text-slate-600">{{ $activity->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li>No hay actividad registrada.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>