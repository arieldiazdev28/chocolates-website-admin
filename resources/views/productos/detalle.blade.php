<x-layout>
    <x-slot name="title">Detalles del Producto</x-slot>

    <div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
        <div class="max-w-4xl w-full bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="md:flex md:items-stretch">

                <!-- Imagen del producto -->
                <div class="md:w-1/2 h-80 overflow-hidden flex items-center justify-center bg-gray-100">
                    <img
                        src="{{ Storage::url($producto->imagen_path) }}"
                        alt="{{ $producto->nombre }}"
                        class="object-cover w-full h-full"
                    >
                </div>

                <!-- Detalles del producto -->
                <div class="md:w-1/2 p-6 flex flex-col justify-around">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $producto->nombre }}</h2>
                        <p class="mt-4 text-gray-600 text-sm">{{ $producto->descripcion }}</p>
                        <div class="mt-6">
                            <span class="text-lg font-medium text-gray-800">Precio:</span>
                            <span class="text-2xl font-bold text-green-600">${{ number_format($producto->precio, 2) }}</span>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-8 flex flex-col sm:flex-row sm:justify-start gap-4">
                        <form action="{{ route('productos.edit', $producto->id) }}" method="GET">
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white text-sm cursor-pointer font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-200">
                                <i class="fa-solid fa-pen"></i> Editar
                            </button>
                        </form>

                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que querés eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-red-600 text-white text-sm cursor-pointer font-semibold rounded-lg shadow hover:bg-red-700 transition duration-200">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
