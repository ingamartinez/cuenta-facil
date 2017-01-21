<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DetalleCompra
 *
 * @property integer $compra_id
 * @property integer $producto_proveedor_id
 * @property integer $cantidad
 * @property float $precio
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra whereCompraId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra whereProductoProveedorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra whereCantidad($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra wherePrecio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleCompra whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DetalleCompra extends Model
{
    protected $table = 'detalle_compra';
}
