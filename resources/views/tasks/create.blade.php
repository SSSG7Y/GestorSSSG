<x-app-layout>
    <div class="min-h-screen bg-slate-950 p-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-black mb-8">Nueva <span class="text-indigo-400">Tarea</span></h1>
            
            <div class="bg-slate-900/70 border border-slate-800 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
                <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-slate-400 mb-2">Título</label>
                        <input type="text" name="titulo" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                        @error('titulo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-2">Prioridad</label>
                            <select name="prioridad" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white">
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-2">Fecha Límite</label>
                            <input type="date" name="due_date" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-400 mb-2">Descripción</label>
                        <textarea name="descripcion" rows="4" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-4 rounded-xl font-bold transition-all">
                        Crear Tarea
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>