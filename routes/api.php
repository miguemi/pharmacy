<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('productos', ProductoController::class)
    ->names('productos');
Route::resource('proveedores', ProveedorController::class);
Route::resource('ventas', VentaController::class);
