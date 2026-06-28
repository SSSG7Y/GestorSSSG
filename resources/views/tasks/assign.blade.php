<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white p-8">
        <div class="max-w-xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">
            <h1 class="text-2xl font-bold mb-6">Asignar tarea: <span class="text-indigo-400">{{ $task->titulo }}</span></h1>
            
            <form action="{{ route('projects.tasks.assign.update', [$project, $task]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label for="user_id" class="block text-sm font-medium text-slate-400 mb-2">Seleccionar Colaborador</label>
                    <select name="user_id" id="user_id" class="w-full bg-slate-800 border-none rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 text-white">
                        <option value="">-- Sin asignar --</option>
                        @foreach($project->members as $member)
                            <option value="{{ $member->id }}" {{ $task->user_id == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('projects.tasks.index', $project) }}" class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 transition">Cancelar</a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 transition font-bold">Guardar Asignación</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>