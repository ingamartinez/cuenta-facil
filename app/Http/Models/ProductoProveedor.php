<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoProveedor extends Model
{
    protected $table = 'producto_proveedor';

    protected $fillable = [
        'cantidad', 'precio_ofrecido', 'estado'
    ];
}
