@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Venta</h1>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('producto_id', $venta->producto_id) == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} - ${{ $producto->precio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad', $venta->cantidad) }}" required min="1">
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de la Venta:</label>
            <input type="date" name="fecha" class="form-control" id="fecha" value="{{ old('fecha', $venta->fecha) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
