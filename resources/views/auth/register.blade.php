<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolates | Crear una cuenta</title>
    {{-- Importar Tailwind --}}
    @vite('resources/css/app.css')
</head>
<body>
    <div class="w-full h-dvh flex justify-center items-center">
        <form method="POST" action="{{ route('register') }}" class="w-full max-w-md mx-auto rounded-xl p-8 space-y-6 shadow-md">
            @csrf

            @if (session('error'))
            <div class="text-red-600 text-sm text-center">
                {{ session('error') }}
            </div>
            @endif

            <h2 class="text-2xl font-bold text-center text-gray-800">
                Crear una cuenta
            </h2>

            <!-- Usuario -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de usuario</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required autofocus">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required autofocus">
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Confirmación de contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Botón -->
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                    Crear
                </button>
            </div>

            <div class="text-center text-sm text-gray-600">
                ¿Ya tienes una cuenta? <a href="{{ route('show.login') }}" class="text-blue-600 hover:underline">Iniciar sesión</a>
            </div>

            <!-- Validación de errores -->
            @if ($errors->any())
                <div class="mt-4">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</body>
</html>

