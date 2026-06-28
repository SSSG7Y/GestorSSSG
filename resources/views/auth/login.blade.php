<x-guest-layout>
    <div class="h-screen flex items-center justify-center bg-slate-950 px-6 overflow-hidden relative" 
         x-data="{ showPassword: false }">
        
        <div class="fixed inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black -z-50"></div>

        <div class="w-full max-w-md z-10 animate-fade-in">
            <div class="bg-slate-900/80 border border-slate-700 backdrop-blur-xl rounded-3xl p-10 shadow-2xl">
                
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-black text-white">Gestor <span class="text-indigo-400">SSSG</span></h1>
                    <p class="text-slate-400 mt-3">Inicia sesión para continuar</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 text-red-500 rounded-2xl p-4 mb-6 text-center text-sm font-medium animate-pulse">
                        Contraseña o Correo incorrectos
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full rounded-2xl bg-slate-800 border {{ $errors->any() ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 focus:border-indigo-500 outline-none transition">
                    </div>

                    <div class="mt-6 relative">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Contraseña</label>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required
                               class="w-full rounded-2xl bg-slate-800 border {{ $errors->any() ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 pr-12 focus:border-indigo-500 outline-none transition">
                        
                        <button type="button" @click="showPassword = !showPassword" 
                                class="absolute right-4 top-[38px] text-slate-400 hover:text-white transition">
                            <span x-text="showPassword ? '👁️' : '🙈'"></span>
                        </button>
                    </div>

                    <button type="submit" class="w-full mt-8 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-2xl transition shadow-lg shadow-indigo-600/20 active:scale-95">
                        Iniciar Sesión
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-slate-400 text-sm">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Regístrate aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>