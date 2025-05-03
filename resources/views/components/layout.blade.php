<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolates | {{ $title ?? 'Dashboard' }}</title>
    {{-- Importar Tailwind --}}
    @vite('resources/css/app.css')
    {{-- Importar Alpine.js --}}
    @vite('resources/js/app.js')
    {{-- Importar font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Importar Boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="bg-gray-100 text-gray-800 font-sans min-h-screen flex">

        <!-- Sidebar-->
        <aside class="w-64 bg-white hidden md:block">
            <div class="p-4 flex justify-center items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-semibold">
                    <img src="{{ asset('images/chocolates_logo.png') }}" alt="Logo de Chocolates" loading="lazy" class="w-20 h-auto">
                </a>
            </div>
            <nav class="p-4 flex flex-col gap-5">
                <!-- Productos -->
                <a href="{{ route('productos.index') }}" class="bg-rosa rounded-xl shadow h-35 w-full flex flex-col justify-center items-center gap-1.5">
                    <h3 class="text-lg font-semibold">Productos <i class="fa-solid fa-cubes-stacked"></i></h3>
                    <p class="text-gray-600 text-center">Gestiona los productos del catálogo</p>
                </a>

                <!-- Pedidos -->
                <a href="{{ route('pedidos.index') }}" class="bg-lavanda rounded-xl shadow h-35 w-full flex flex-col justify-center items-center gap-1.5">
                    <h3 class="text-lg font-semibold">Pedidos <i class="fa-solid fa-calendar"></i></h3>
                    <p class="text-gray-600 text-center">Consulta pedidos recientes</p>
                </a>

            </nav>
        </aside>
        <!-- Main -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white p-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold flex items-center gap-2">
                    ¡Los mejores chocolates de El Salvador! <i class="fa-solid fa-heart text-pink-400"></i>
                </h1>

                <!-- Usuario + Logout sin imagen -->
                <div class="flex items-center gap-4">
                    @auth
                    <span class="font-semibold text-gray-700 text-base">Hola, {{ Auth::user()->name }}</span>
                    @endauth
                    <form method="POST" action="{{ route('logout') }}"">
                         @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition text-sm font-semibold flex items-center gap-2">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </header>

            {{-- Contenedor donde se muestra el contenido dinámico de la página web --}}
            <main class="container">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>

