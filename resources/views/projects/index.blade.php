<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-white">Mis Proyectos</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-6">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
            <table class="w-full text-left text-slate-300">
                <thead class="bg-slate-950 text-slate-400">
                    <tr>
                        <th class="p-6">Nombre</th>
                        <th class="p-6">Estado</th>
                        <th class="p-6">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @foreach($projects as $project)
                        <tr>
                            <td class="p-6 text-white font-bold">{{ $project->name }}</td>
                            <td class="p-6">{{ $project->status }}</td>
                            <td class="p-6 flex gap-3">
                                @can('update', $project)
                                    <a href="{{ route('projects.edit', $project) }}" class="text-indigo-400">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>2