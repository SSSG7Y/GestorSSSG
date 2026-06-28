<x-guest-layout>
    <div class="h-screen flex items-center justify-center bg-slate-950 px-6 overflow-hidden relative" 
         x-data="{ showPassword: false }">
        
        <div class="fixed inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black -z-50"></div>
        <div class="fixed top-0 left-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl -z-40"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl -z-40"></div>

        <div class="relative w-full max-w-md z-10 animate-fade-in">
            <div class="bg-slate-900/80 border border-slate-700 backdrop-blur-xl rounded-3xl p-8 lg:p-10 shadow-2xl">
                
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-black text-white">Crear Cuenta</h1>
                    <p class="text-slate-400 mt-2">Únete a GestorSSSG hoy mismo</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               class="w-full rounded-2xl bg-slate-800 border {{ $errors->has('name') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 focus:border-indigo-500 outline-none transition-all">
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                               class="w-full rounded-2xl bg-slate-800 border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 focus:border-indigo-500 outline-none transition-all">
                        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Contraseña</label>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required 
                               class="w-full rounded-2xl bg-slate-800 border {{ $errors->has('password') ? 'border-red-500' : 'border-slate-700' }} text-white px-4 py-3 pr-12 focus:border-indigo-500 outline-none transition-all">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-[38px] text-slate-400 hover:text-white">
                            <span x-text="showPassword ? '👁️' : '🙈'"></span>
                        </button>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Confirmar contraseña</label>
                        <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" required 
                               class="w-full rounded-2xl bg-slate-800 border border-slate-700 text-white px-4 py-3 pr-12 focus:border-indigo-500 outline-none transition-all">
                        @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" 
                            class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-600/20 active:scale-95">
                        Registrarse
                    </button>

                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-white text-sm transition">
                            ¿Ya tienes cuenta? <span class="text-indigo-400 underline decoration-indigo-400/30 underline-offset-4">Inicia sesión</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>