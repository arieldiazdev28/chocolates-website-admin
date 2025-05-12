<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pedido;


class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::latest()->get(); // O ->paginate(10) si quieres paginación
        return view('pedidos.index', compact('pedidos'));
    }

    public function actualizarEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aceptado,rechazado',
        ]);

        $pedido->estado = $request->input('estado');
        $pedido->save();

        return back()->with('success', 'Estado del pedido actualizado.');
    }
}