<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-white">{{ $project->name }}</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-6">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8">
            <h3 class="text-xl text-white font-bold mb-6">Tareas</h3>
            
            @can('update', $project)
                <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="mb-6 flex gap-4">
                    @csrf
                    <input type="text" name="title" placeholder="Nueva tarea..." class="bg-slate-950 border border-slate-700 rounded-xl text-white px-4 py-2 w-full">
                    <button type="submit" class="bg-indigo-600 px-6 py-2 rounded-xl text-white">Agregar</button>
                </form>
            @endcan

            <div class="space-y-4">
                @foreach($project->tasks as $task)
                    <div class="flex items-center justify-between p-4 bg-slate-950 rounded-xl border border-slate-800">
                        <span class="text-slate-300 {{ $task->is_completed ? 'line-through' : '' }}">{{ $task->title }}</span>
                        
                        @can('update', $project)
                            <form action="{{ route('tasks.status', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-indigo-400 text-sm">Cambiar estado</button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>