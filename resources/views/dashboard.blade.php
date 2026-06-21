<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between bg-slate-950 border border-slate-800 rounded-3xl p-6">
            <div>
                <h2 class="text-3xl font-black text-white">Dashboard</h2>
                <p class="text-slate-400 mt-1">Panel de control de proyectos «GestorSSSG»</p>
            </div>
            <div class="flex items-center gap-2 px-4 py-2 bg-slate-900 border border-slate-800 rounded-full">
                <div class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-xs font-medium text-slate-300 uppercase tracking-wider">Sistema Online</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach(['Proyectos' => [$totalProyectos, 'indigo'], 'Tareas' => [$totalTareas, 'cyan'], 'Usuarios' => [$totalUsuarios, 'purple']] as $label => $data)
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-slate-700 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-slate-400 text-sm font-medium">{{ $label }}</p>
                                <h3 class="text-4xl font-black text-white mt-2">{{ $data[0] }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-{{$data[1]}}-600/10 flex items-center justify-center text-{{$data[1]}}-400 text-xl">
                                {{ $label === 'Proyectos' ? '📁' : ($label === 'Tareas' ? '✅' : '👥') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-slate-900 border border-slate-800 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-white">¡Bienvenido de nuevo, {{ auth()->user()->name }}!</h3>
                    <p class="text-slate-400 mt-3 max-w-xl">Gestiona tus proyectos de forma eficiente. Estás colaborando actualmente en un entorno de alto rendimiento.</p>
                    
                    <div class="mt-8 p-6 bg-slate-950 rounded-2xl border border-slate-800">
                        <div class="flex justify-between mb-3 text-sm">
                            <span class="text-slate-300">Progreso global del sistema</span>
                            <span class="text-indigo-400 font-bold">78%</span>
                        </div>
                        <div class="w-full h-3 bg-slate-800 rounded-full">
                            <div class="h-full w-[78%] bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
                    <h3 class="text-xl font-bold text-white mb-6">Actividad reciente</h3>
                    <div class="space-y-3">
                        @foreach([['Nuevo proyecto', '2h'], ['Tarea completada', '5h'], ['Usuario registrado', '1d']] as $act)
                            <div class="flex items-center gap-4 p-4 bg-slate-950/50 rounded-2xl border border-slate-800/50">
                                <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                <div>
                                    <p class="text-sm text-white font-medium">{{ $act[0] }}</p>
                                    <p class="text-xs text-slate-500">{{ $act[1] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>