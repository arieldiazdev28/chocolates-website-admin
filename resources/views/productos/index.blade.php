<!-- Vista que muestra los productos del catalogo y permitir eliminarlos -->
<x-layout>
    <x-slot name="title">Productos</x-slot>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif
    <!-- Contenido -->
    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-4 bg-white rounded-2xl mb-6">
            <!-- Barra de búsqueda -->
            <form action="{{ route('productos.search') }}" method="GET" class="relative w-full md:w-1/2">
                <input type="text" name="query" placeholder="Buscar producto por nombre..." value="{{ request('query') }}"
                    class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </form>

            <!-- Botón para crear nuevo producto -->
            <a href="{{ route('productos.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 transition duration-200">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>

        </div>


        <!-- Tabla de productos -->
        @if(isset($query))
            <div class="mb-4 text-gray-600">
                Resultados para: <strong>"{{ $query }}"</strong>
            </div>
        @endif

        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center justify-center gap-2">Productos en el catálogo</h1>
            <div class="overflow-x-auto rounded-xl shadow">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <thead class="bg-gray-100 text-gray-600 text-sm">
                        <tr>
                            <th class="px-6 py-3 text-center">ID</th>
                            <th class="px-6 py-3 text-center">Nombre</th>
                            <th class="px-6 py-3 text-center">Precio</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productosTable" class="text-gray-700">
                        <!-- Productos listados dinámicamente aquí -->
                        @foreach ($productos as $producto)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $producto->id }}</td>
                            <td class="px-6 py-4 text-center">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4 text-center">${{ number_format($producto->precio, 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('productos.show', $producto->id) }}" class="text-blue-500 hover:text-blue-700">Ver detalle</a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($productos->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay productos disponibles.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación -->
        <div class="m-4">
            {{ $productos->links() }}
        </div>
    </div>
</x-layout>

