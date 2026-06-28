<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestorSSSG</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media (max-width: 1023px) {
            body { overflow: hidden; height: 100vh; }
        }

        .btn-shine { position: relative; overflow: hidden; }
        .btn-shine::after { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent); transform: rotate(45deg); transition: 0.5s; opacity: 0; }
        .btn-shine:hover::after { opacity: 1; transform: rotate(45deg) translate(20%, 20%); }
        
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-10px) rotate(5deg); } }
        .animate-float { animation: float 3s ease-in-out infinite; }
        
        .orbit-path { fill: none; stroke: rgba(165, 180, 252, 0.4); stroke-width: 2; }
        .electron { r: 8; fill: white; filter: drop-shadow(0 0 10px white); offset-path: path('M200,200 m-180,0 a180,60 0 1,0 360,0 a180,60 0 1,0 -360,0'); animation: move linear infinite; }
        @keyframes move { from { offset-distance: 0%; } to { offset-distance: 100%; } }
        
        .animate-fade-in { animation: fadeIn 1s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen">

    <div class="fixed inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black -z-50"></div>

    <div class="fixed inset-0 flex items-center justify-center -z-40 pointer-events-none">
        <svg viewBox="0 0 400 400" preserveAspectRatio="xMidYMid meet" class="w-full h-[50vh] lg:h-[80vh] max-w-[800px] opacity-30">
            <ellipse cx="200" cy="200" rx="180" ry="60" class="orbit-path"/>
            <ellipse cx="200" cy="200" rx="180" ry="60" class="orbit-path" transform="rotate(60 200 200)"/>
            <ellipse cx="200" cy="200" rx="180" ry="60" class="orbit-path" transform="rotate(120 200 200)"/>
            <g><circle class="electron" style="animation-duration: 3s;" /></g>
            <g transform="rotate(60 200 200)"><circle class="electron" style="animation-duration: 4.5s;" /></g>
            <g transform="rotate(120 200 200)"><circle class="electron" style="animation-duration: 6s;" /></g>
        </svg>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4 lg:p-6">
        <div class="max-w-6xl w-full flex flex-col lg:grid lg:grid-cols-2 gap-8 items-center justify-center">
            
            <div class="animate-fade-in flex flex-col items-center lg:items-start text-center lg:text-left w-full">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-slate-900/70 border border-slate-700 backdrop-blur-md mb-6">
                    <span class="text-cyan-400 text-sm font-medium tracking-widest uppercase">Sistema Inteligente</span>
                </div>
                <h1 class="text-4xl lg:text-7xl font-black leading-tight">Gestor <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400 animate-pulse">SSSG</span></h1>
                <p class="mt-4 text-slate-400 text-md lg:text-lg leading-relaxed max-w-lg">Plataforma moderna para administración de proyectos, tareas y colaboración de equipos.</p>
                
                <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-shine px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 font-bold">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-shine px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 font-bold">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl border border-slate-700 bg-slate-900/50 hover:bg-slate-800 backdrop-blur-md font-semibold">Registrarse</a>
                    @endauth
                </div>
            </div>

            <div class="relative animate-fade-in z-20 w-full max-w-sm lg:max-w-none">
                <div class="bg-slate-900/80 border border-slate-700 rounded-3xl p-6 lg:p-8 backdrop-blur-xl shadow-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl lg:text-2xl font-bold">Dashboard Preview</h2>
                        <div class="w-12 h-12 lg:w-16 lg:h-16 rounded-2xl bg-indigo-600 flex items-center justify-center font-black text-sm lg:text-lg animate-float">SSSG</div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="bg-slate-800/50 rounded-2xl p-4 border border-slate-700/50">
                            <p class="text-slate-400 text-xs">Proyectos Totales</p>
                            <h3 class="text-2xl lg:text-3xl font-bold mt-1">{{ \App\Models\Project::count() }}</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-slate-800/50 rounded-2xl p-4 border border-slate-700/50">
                                <p class="text-slate-400 text-xs">Tareas</p>
                                <h3 class="text-xl lg:text-2xl font-bold mt-1">{{ \App\Models\Task::count() }}</h3>
                            </div>
                            <div class="bg-slate-800/50 rounded-2xl p-4 border border-slate-700/50">
                                <p class="text-slate-400 text-xs">Usuarios</p>
                                <h3 class="text-xl lg:text-2xl font-bold mt-1">{{ \App\Models\User::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>