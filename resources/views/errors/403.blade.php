<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen text-white bg-slate-950">
        <h1 class="text-6xl font-black">403</h1>
        <p class="text-xl mt-4">Acceso denegado</p>
        <a href="{{ route('dashboard') }}" class="mt-6 px-6 py-2 bg-indigo-600 rounded-xl hover:bg-indigo-700 transition">
            Volver al Dashboard
        </a>
    </div>
</x-app-layout>