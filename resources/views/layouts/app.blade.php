<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href={{ asset('css/app.css') }}>
        <title>Devstagram - @yield('title')</title>
        <script src={{ asset('js/app.js') }}></script>
        @vite('resources/css/app.css')
    </head>
    <body >
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">DevStagram</h1>
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600" href="">Login</a>
                    <a class="font-bold uppercase text-gray-600" href={{ route('register') }}>Crear Cuenta</a>
                </nav>
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
            @yield('content')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
            Devstagram - Todos los derechos reservados 
            {{ now()->year }}
        </footer>

    </body>
</html>
