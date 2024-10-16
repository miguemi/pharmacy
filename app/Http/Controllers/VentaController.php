<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto; // Para seleccionar los productos disponibles
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas y enviarlas a la vista
        $ventas = Venta::with('producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los productos para mostrarlos en el formulario de ventas
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el producto y calcular el total
        $producto = Producto::find($request->producto_id);
        $total = $producto->precio * $request->cantidad;

        // Crear la venta
        Venta::create([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'total' => $total,
        ]);

        // Redirigir a la lista de ventas
        return redirect()->route('ventas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venta = Venta::with('producto')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la venta por ID y mostrar el formulario para editarla
        $venta = Venta::findOrFail($id);
        $productos = Producto::all();  // Obtener los productos disponibles
        return view('ventas.edit', compact('venta', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Buscar la venta y actualizarla
        $venta = Venta::findOrFail($id);
        $producto = Producto::find($request->producto_id);
        $total = $producto->precio * $request->cantidad;

        $venta->update([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'total' => $total,
        ]);

        // Redirigir a la lista de ventas
        return redirect()->route('ventas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar la venta y eliminarla
        $venta = Venta::findOrFail($id);
        $venta->delete();

        // Redirigir a la lista de ventas
        return redirect()->route('ventas.index');
    }
}
