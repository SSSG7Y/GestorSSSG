<x-guest-layout>

    <div class="h-screen flex items-center justify-center bg-slate-950 px-6 overflow-hidden relative">

        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

        <div class="absolute top-0 left-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>

        <div class="relative w-full max-w-md z-10">

            <div class="bg-slate-900/70 border border-slate-800 backdrop-blur-xl rounded-3xl p-10 shadow-2xl">

                <div class="text-center mb-8">

                    <h1 class="text-4xl font-black text-white">

                        GestorSSSG

                    </h1>

                    <p class="text-slate-400 mt-3">

                        Inicia sesión para continuar

                    </p>

                </div>

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div>

                        <label class="block text-sm font-medium text-slate-300 mb-2">

                            Correo electrónico

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               class="w-full rounded-2xl bg-slate-800 border border-slate-700 text-white px-4 py-3">

                    </div>

                    <div class="mt-6">

                        <label class="block text-sm font-medium text-slate-300 mb-2">

                            Contraseña

                        </label>

                        <input type="password"
                               name="password"
                               required
                               class="w-full rounded-2xl bg-slate-800 border border-slate-700 text-white px-4 py-3">

                    </div>

                    <button type="submit"
                            class="w-full mt-8 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-2xl transition">

                        Iniciar Sesión

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>