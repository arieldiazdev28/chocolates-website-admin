<!-- Vista que muestra todos los pedidos realizados por los clientes -->
<x-layout>
    <x-slot name="title">Pedidos</x-slot>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif

    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center justify-center gap-2">Pedidos de clientes</h1>

        <div class="overflow-x-auto rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-center">ID</th>
                        <th class="px-4 py-3 text-center">Cliente</th>
                        <th class="px-4 py-3 text-center">Productos</th>
                        <th class="px-4 py-3 text-center">Total</th>
                        <th class="px-4 py-3 text-center">Entrega</th>
                        <th class="px-4 py-3 text-center">Estado</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($pedidos as $pedido)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-center">{{ $pedido->id }}</td>
                        <td class="px-4 py-3 text-center">{{ $pedido->cliente }}</td>
                        <td class="px-4 py-3 text-left text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($pedido->productos as $producto)
                                <li>{{ $producto['nombre'] }} x{{ $producto['cantidad'] }}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="px-4 py-3 text-center">${{ number_format($pedido->total, 2) }}</td>
                        <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($pedido->fecha_entrega)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center capitalize font-semibold 
                                {{ $pedido->estado === 'pendiente' ? 'text-yellow-500' : ($pedido->estado === 'aceptado' ? 'text-green-600' : 'text-red-600') }}">
                            {{ $pedido->estado }}
                        </td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <form action="{{ route('pedidos.actualizarEstado', $pedido) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="estado" value="aceptado">
                                <button class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">Aceptar</button>
                            </form>
                            <form action="{{ route('pedidos.actualizarEstado', $pedido) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="estado" value="rechazado">
                                <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay pedidos aún.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
       {{--  <div class="mt-4">
            {{ $pedidos->links() }}
        </div>
        --}}
    </div>
</x-layout>

