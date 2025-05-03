<x-layout>
    <x-slot name="title">Crear nuevo producto</x-slot>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md mt-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Crear nuevo producto</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-producto-formulario :action="route('productos.store')" :method="'POST'" :buttonText="'Guardar Producto'" />
    </div>
</x-layout>