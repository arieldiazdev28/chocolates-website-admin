@php
    $producto = $producto ?? null;
    $imagenUrl = !empty($producto?->imagen_path) ? Storage::url($producto->imagen_path) : null;
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <!-- Campo Nombre -->
    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto"
            class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            value="{{ old('nombre', $producto->nombre ?? '') }}" required>
    </div>

    <!-- Campo Precio -->
    <div>
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio:</label>
        <input type="number" name="precio" id="precio" placeholder="Precio del producto" step="0.01"
            class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            value="{{ old('precio', $producto->precio ?? '') }}" required>
    </div>

    <!-- Campo Descripción -->
    <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="4" placeholder="Descripción del producto"
            class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
    </div>

    <!-- Campo Imagen -->
    <div>
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del producto:</label>

        <div id="dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg relative overflow-hidden group">
            <input id="imagen" name="imagen" type="file" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(event)" />

            @if ($imagenUrl)
                <img id="preview-image" src="{{ $imagenUrl }}" alt="Imagen actual"
                    class="h-48 w-full object-cover rounded-lg group-hover:opacity-75 transition-opacity duration-300">
            @else
                <div id="placeholder" class="flex flex-col items-center justify-center h-48 w-full bg-gray-100 rounded-lg">
                    <svg class="h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H20a4 4 0 00-4 4v28a4 4 0 004 4h8a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16 16h16M16 24h16M16 32h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-gray-500 mt-2 text-sm">Subir imagen</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Botón -->
    <div class="flex justify-around">
    <button type="submit"
            class="bg-red-500 text-white px-6 py-2 rounded-lg shadow hover:bg-red-700 cursor-pointer transition-all">
            <a href="{{ route('productos.index') }}">Cancelar</a>
        </button>

        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 cursor-pointer transition-all">
            {{ $buttonText }}
        </button>
    </div>
</form>

<!-- Script para vista previa de la imagen -->
<script>
function previewImage(event) {
    const file = event.target.files[0];

    if (file) {
        if (!file.type.startsWith('image/')) {
            alert("Solo se permiten archivos de imagen.");
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('preview-image');
            let placeholder = document.getElementById('placeholder');

            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'preview-image';
                preview.className = 'h-48 w-full aspect-video object-cover rounded-lg group-hover:opacity-75 transition-opacity duration-300';
                document.getElementById('dropzone').appendChild(preview);
            }

            preview.src = e.target.result;
            if (placeholder) {
                placeholder.style.display = 'none';
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
