<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GestorSSSG') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-950 text-white">
        <div class="min-h-screen">
            @include('layouts.navigation')
            
            @if (session('status'))
                <div class="max-w-7xl mx-auto px-6 pt-6">
                    <div class="bg-indigo-600/20 border border-indigo-500 text-indigo-400 p-4 rounded-2xl text-center font-medium shadow-lg">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @isset($header)
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-6 ">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>