<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductoProveedor
 *
 * @property integer $id
 * @property integer $cantidad
 * @property float $precio_ofrecido
 * @property string $estado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $proveedor_id
 * @property integer $producto_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereCantidad($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor wherePrecioOfrecido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereProveedorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductoProveedor whereProductoId($value)
 * @mixin \Eloquent
 */
class ProductoProveedor extends Model
{
    protected $table = 'producto_proveedor';

    protected $fillable = [
        'cantidad', 'precio_ofrecido', 'estado'
    ];
}
