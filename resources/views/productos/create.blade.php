@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Producto</h1>


    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" class="form-control" id="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="text" name="precio" class="form-control" id="precio" value="{{ old('precio') }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock') }}" required>
        </div>

        <div class="form-group">
            <label for="proveedor_id">Proveedor:</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
