@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nueva Venta</h1>


    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ $producto->precio }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad') }}" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
