<?php

namespace App\Http\Controllers;

use App\Models\Proveedor; // Importar el modelo Proveedor
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los proveedores y enviarlos a la vista
        $proveedores = Proveedor::all();
        return view('proveedores.proveedors', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear un nuevo proveedor
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        // Crear un nuevo proveedor en la base de datos
        Proveedor::create($request->all());

        // Redirigir a la lista de proveedores después de crear uno nuevo
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar detalles de un proveedor específico (opcional si necesitas implementarlo)
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar el proveedor por ID y mostrar el formulario para editar
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de actualización
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        // Buscar el proveedor y actualizar sus datos
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        // Redirigir a la lista de proveedores después de actualizar
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el proveedor y eliminarlo
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        // Redirigir a la lista de proveedores después de eliminar
        return redirect()->route('proveedores.index');
    }
}
