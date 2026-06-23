<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white p-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-black mb-8">Editar <span class="text-indigo-400">Tarea</span></h1>

            @if ($errors->any())
                <div class="bg-red-600/20 border border-red-500 p-4 rounded-xl mb-6 text-red-200">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-slate-900/70 border border-slate-800 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
                <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Título</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $task->titulo) }}" 
                            class="w-full bg-slate-950 border border-slate-700 rounded-2xl px-4 py-3 outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Estado</label>
                            <select name="estado" class="w-full bg-slate-950 border border-slate-700 rounded-2xl px-4 py-3 outline-none">
                                @foreach(['pendiente', 'en_progreso', 'completada'] as $e)
                                    <option value="{{ $e }}" {{ old('estado', $task->estado) == $e ? 'selected' : '' }}>{{ ucfirst($e) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Prioridad</label>
                            <select name="prioridad" class="w-full bg-slate-950 border border-slate-700 rounded-2xl px-4 py-3 outline-none">
                                @foreach(['baja', 'media', 'alta'] as $p)
                                    <option value="{{ $p }}" {{ old('prioridad', $task->prioridad) == $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Fecha Límite</label>
                        <input type="date" name="due_date" 
                            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}" 
                            class="w-full bg-slate-950 border border-slate-700 rounded-2xl px-4 py-3 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Descripción</label>
                        <textarea name="descripcion" rows="4" 
                            class="w-full bg-slate-950 border border-slate-700 rounded-2xl px-4 py-3 outline-none">{{ old('descripcion', $task->descripcion) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 font-bold transition-all">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>