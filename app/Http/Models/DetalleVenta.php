<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DetalleVenta
 *
 * @property integer $venta_id
 * @property integer $inventario_id
 * @property integer $cantidad
 * @property float $precio
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta whereVentaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta whereInventarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta whereCantidad($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta wherePrecio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DetalleVenta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DetalleVenta extends Model
{
    protected $table = "detalle_venta";
}
