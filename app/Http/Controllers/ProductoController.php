<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        // Muestra todos los productos del catálogo
        $productos = Producto::orderBy('id', 'asc')->paginate(10);

        return view('productos.index', ['productos' => $productos]);
    }

    public function show($id)
    {
        // Muestra un producto específico
        $producto = Producto::findOrFail($id);
        return view('productos.detalle', ['producto' => $producto]);
    }

    public function create()
    {
        // Muestra el formulario para crear un nuevo producto
        return view('productos.crear');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/[a-zA-Z]/'],
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes');
            $validated['imagen_path'] = $path;
        }

        // Aquí deberías guardar el producto en la base de datos, por ejemplo:
        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }


    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un producto específico
        $producto = Producto::findOrFail($id);
        return view('productos.editar', ['producto' => $producto]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = Producto::findOrFail($id);

        $datos = $request->only(['nombre', 'precio', 'descripcion']);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen_path && Storage::exists($producto->imagen_path)) {
                Storage::delete($producto->imagen_path);
            }

            // Guardar la nueva imagen
            $path = $request->file('imagen')->store('imagenes');
            $datos['imagen_path'] = $path;
        }

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }


    public function destroy($id)
    {
        // Lógica para eliminar un producto específico de la base de datos
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', '¡Producto eliminado exitosamente!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('productos.index', compact('productos', 'query'));
    }
}
