<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        GestorSSSG
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-950 text-white min-h-screen overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

    <div class="absolute top-0 left-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-6">

        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <div class="inline-flex items-center px-4 py-2 rounded-full bg-slate-900/70 border border-slate-800 backdrop-blur-md mb-6">

                    <span class="text-cyan-400 text-sm font-medium">

                        Sistema Inteligente de Gestión

                    </span>

                </div>

                <h1 class="text-6xl lg:text-7xl font-black leading-tight">

                    Gestor

                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">

                        SSSG

                    </span>

                </h1>

                <p class="mt-6 text-slate-400 text-lg leading-relaxed max-w-xl">

                    Plataforma moderna para administración de proyectos,
                    tareas y colaboración de equipos utilizando Laravel,
                    PostgreSQL y arquitectura profesional.

                </p>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">

                    @auth

                        <a href="{{ route('dashboard') }}"
                           class="px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all duration-300 shadow-2xl shadow-indigo-600/30 font-semibold text-center">

                            Ir al Dashboard

                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition-all duration-300 shadow-2xl shadow-indigo-600/30 font-semibold text-center">

                            Iniciar Sesión

                        </a>

                        <a href="{{ route('register') }}"
                           class="px-8 py-4 rounded-2xl border border-slate-700 bg-slate-900/70 hover:bg-slate-800 transition-all duration-300 backdrop-blur-md font-semibold text-center">

                            Registrarse

                        </a>

                    @endauth

                </div>

            </div>

            <div class="hidden lg:flex justify-center">

                <div class="relative w-full max-w-lg">

                    <div class="absolute inset-0 bg-indigo-600/20 rounded-3xl blur-3xl"></div>

                    <div class="relative bg-slate-900/70 border border-slate-800 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">

                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <h2 class="text-2xl font-bold">

                                    Dashboard Preview

                                </h2>

                                <p class="text-slate-400 text-sm mt-1">

                                    Gestión avanzada de proyectos

                                </p>

                            </div>

                            <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-xl font-bold">

                                G

                            </div>

                        </div>

                        <div class="space-y-4">

                            <div class="bg-slate-800 rounded-2xl p-5 border border-slate-700">

                                <div class="flex justify-between items-center">

                                    <div>

                                        <p class="text-slate-400 text-sm">

                                            Proyectos activos

                                        </p>

                                        <h3 class="text-3xl font-bold mt-1">

                                            12

                                        </h3>

                                    </div>

                                    <div class="text-cyan-400">

                                        +18%

                                    </div>

                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                <div class="bg-slate-800 rounded-2xl p-5 border border-slate-700">

                                    <p class="text-slate-400 text-sm">

                                        Tareas

                                    </p>

                                    <h3 class="text-2xl font-bold mt-2">

                                        148

                                    </h3>

                                </div>

                                <div class="bg-slate-800 rounded-2xl p-5 border border-slate-700">

                                    <p class="text-slate-400 text-sm">

                                        Usuarios

                                    </p>

                                    <h3 class="text-2xl font-bold mt-2">

                                        32

                                    </h3>

                                </div>

                            </div>

                            <div class="bg-slate-800 rounded-2xl p-5 border border-slate-700">

                                <div class="flex justify-between items-center mb-4">

                                    <span class="text-slate-300">

                                        Progreso General

                                    </span>

                                    <span class="text-indigo-400 font-semibold">

                                        78%

                                    </span>

                                </div>

                                <div class="w-full h-3 bg-slate-700 rounded-full overflow-hidden">

                                    <div class="h-full w-[78%] bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>