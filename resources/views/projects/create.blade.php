<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">Nuevo Proyecto</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto">
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                            class="w-full rounded-2xl bg-slate-950 border {{ $errors->has('nombre') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                        @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Descripción</label>
                        <textarea name="descripcion" rows="5"
                            class="w-full rounded-2xl bg-slate-950 border {{ $errors->has('descripcion') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Estado</label>
                        <select name="estado" class="w-full rounded-2xl bg-slate-950 border {{ $errors->has('estado') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3">
                            <option value="activo" @selected(old('estado') === 'activo')>Activo</option>
                            <option value="pausado" @selected(old('estado') === 'pausado')>Pausado</option>
                            <option value="finalizado" @selected(old('estado') === 'finalizado')>Finalizado</option>
                        </select>
                        @error('estado') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition font-semibold text-white">Crear Proyecto</button>
                        <a href="{{ route('projects.index') }}" class="px-6 py-3 rounded-2xl bg-slate-800 hover:bg-slate-700 transition text-white">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>