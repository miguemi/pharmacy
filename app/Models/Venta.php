<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['producto_id', 'cantidad', 'total'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

