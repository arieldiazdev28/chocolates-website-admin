<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolates | ¡Bienvenido!</title>
    {{-- Importar Tailwind --}}
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Contenido -->
    <div class="w-full h-dvh flex flex-col gap-4 justify-center items-center">
        <img src="{{ asset('images/chocolates_logo.png') }}" alt="Logo de Chocolates" loading="lazy" class="w-30 h-auto">
        <h1 class="text-2xl">¡Los mejores chocolates de El Salvador!</h1>
        @auth
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition text-sm font-semibold flex items-center gap-2">Ir al dashboard</a
        @endauth
        @guest
        <a href="{{ route('show.login')}}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition text-sm font-semibold flex items-center gap-2">Iniciar sesión</a>
        @endguest
    </div>
</body>
</html>

