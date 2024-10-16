<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';  // Especificar el nombre correcto de la tabla

    protected $fillable = ['nombre', 'direccion', 'telefono'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
