<?php

namespace App\Http\Controllers;
use App\Models\Producto; // Importar el modelo Producto
use App\Models\Proveedor; // Importar el modelo Proveedor

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
{
    $productos = Producto::with('proveedor')->get();  // Recuperar productos con su proveedor
    return view('productos.products', compact('productos'));
}


public function create()
{
    $proveedores = Proveedor::all();  // Obtener todos los proveedores
    return view('productos.create', compact('proveedores'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedores,id'
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
{
    // Obtener todos los proveedores para el select en el formulario
    $proveedores = Proveedor::all(); 

    // Pasar el producto y los proveedores a la vista
    return view('productos.edit', compact('producto', 'proveedores'));
}

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}