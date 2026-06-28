<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-4xl font-black text-white tracking-tight">{{ $project->nombre }}</h2>
                <p class="text-slate-400 mt-2 text-lg">{{ $project->descripcion }}</p>
            </div>
            @can('update', $project)
                <a href="{{ route('projects.tasks.create', $project) }}" 
                   class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/30 text-white font-semibold flex items-center gap-2">
                    <span>+</span> Nueva Tarea
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $stats = [
                            ['label' => 'Total Tareas', 'count' => $project->tasks->count(), 'color' => 'text-white'],
                            ['label' => 'Completadas', 'count' => $project->tasks->where('estado', 'completada')->count(), 'color' => 'text-emerald-400'],
                            ['label' => 'Pendientes', 'count' => $project->tasks->where('estado', 'pendiente')->count(), 'color' => 'text-yellow-400'],
                        ];
                    @endphp
                    @foreach($stats as $stat)
                        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-slate-700 transition-all">
                            <p class="text-slate-500 text-sm font-medium">{{ $stat['label'] }}</p>
                            <h3 class="text-4xl font-black {{ $stat['color'] }} mt-2">{{ $stat['count'] }}</h3>
                        </div>
                    @endforeach
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Tareas de Alta Prioridad</h3>
                        <a href="{{ route('projects.tasks.index', $project) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold text-sm">Ver todas →</a>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($project->tasks->where('prioridad', 'alta')->take(5) as $task)
                            <div class="bg-slate-950 border border-slate-800 rounded-2xl p-5 flex items-center justify-between hover:border-indigo-500/30 transition-all">
                                <div>
                                    <h4 class="font-bold text-white">{{ $task->titulo }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">Límite: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Sin definir' }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">ALTA</span>
                            </div>
                        @empty
                            <p class="text-center text-slate-500 py-4 italic">No hay tareas de alta prioridad.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Equipo</h3>
                    <ul class="space-y-3 mb-6">
                        @foreach($project->members as $member)
                            <li class="flex justify-between items-center bg-slate-800/50 p-3 rounded-2xl text-sm">
                                <span>
                                    <span class="block text-white font-medium">{{ $member->name }}</span>
                                    <span class="text-indigo-400 text-[10px] uppercase tracking-wider font-bold">{{ $member->pivot->project_role }}</span>
                                </span>
                                @can('update', $project)
                                    <form action="{{ route('members.destroy', [$project, $member]) }}" method="POST" onsubmit="return confirm('¿Eliminar del equipo?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-500 hover:text-red-400 font-bold px-2">✕</button>
                                    </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                    @can('update', $project)
                        <hr class="border-slate-800 my-4">
                        <form action="{{ route('members.store', $project) }}" method="POST" class="space-y-3">
                            @csrf
                            <select name="user_id" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-2 text-white text-sm">
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <select name="role" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-2 text-white text-sm">
                                <option value="lider">Líder</option>
                                <option value="colaborador">Colaborador</option>
                            </select>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl p-2 text-sm font-bold transition-all">Asignar</button>
                        </form>
                    @endcan
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Actividad</h3>
                    <div class="max-h-80 overflow-y-auto pr-2 custom-scrollbar space-y-4">
                        @forelse($project->activities as $activity)
                            <div class="border-l-2 border-slate-700 pl-4">
                                <p class="text-white text-xs font-semibold">{{ $activity->user->name }}</p>
                                <p class="text-slate-400 text-[11px] mt-0.5">
                                    {{ str_replace(['created ', 'updated '], ['creó ', 'actualizó '], $activity->description) }}
                                </p>
                                <span class="text-[9px] text-slate-600 uppercase">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-slate-500 text-sm">No hay actividad.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>