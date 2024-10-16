@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Proveedor</h1>


    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Proveedor:</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion') }}">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono') }}">
        </div>

        <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
