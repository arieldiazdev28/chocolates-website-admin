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
    <div class="w-full h-dvh flex flex-col justify-center items-center">
        <h1>¡Los mejores chocolates de El Salvador!</h1>
        @auth
        <a href="{{ route('dashboard') }}">Ir al dashboard</a
        @endauth
        @guest
        <a href="{{ route('show.login')}}">Iniciar sesión</a>
        @endguest
    </div>
</body>
</html>

