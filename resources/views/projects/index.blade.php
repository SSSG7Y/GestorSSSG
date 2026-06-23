<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-black text-white">Mis Proyectos</h2>
            @can('create', App\Models\Project::class)
                <a href="{{ route('projects.create') }}" class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/30">
                    + Nuevo Proyecto
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            @if($projects->count())
                <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                    <table class="w-full text-left">
                        <thead class="bg-slate-950 border-b border-slate-800">
                            <tr>
                                <th class="p-6 text-slate-400">Proyecto</th>
                                <th class="p-6 text-slate-400">Estado</th>
                                <th class="p-6 text-slate-400">Propietario</th>
                                <th class="p-6 text-slate-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @foreach($projects as $project)
                                <tr class="hover:bg-slate-800/40">
                                    <td class="p-6 text-white font-bold">{{ $project->nombre }}</td>
                                    <td class="p-6 capitalize text-slate-300">{{ $project->estado }}</td>
                                    <td class="p-6 text-slate-300">{{ $project->owner->name ?? 'N/A' }}</td>
                                    <td class="p-6 flex gap-4">
                                        <a href="{{ route('projects.show', $project) }}" class="text-cyan-400">Ver</a>
                                        @can('update', $project)
                                            <a href="{{ route('projects.edit', $project) }}" class="text-indigo-400">Editar</a>
                                        @endcan
                                        @can('delete', $project)
                                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('¿Eliminar proyecto?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>