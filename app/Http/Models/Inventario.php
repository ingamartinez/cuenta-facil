<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Inventario
 *
 * @property integer $id
 * @property string $cantidad
 * @property string $stock_min
 * @property string $stock_max
 * @property float $precio_compra_ponderado
 * @property float $precio_venta_actual
 * @property string $estado
 * @property integer $producto_id
 * @property integer $tendero_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $ganancia_percent
 * @property-read mixed $ganancia_pesos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereCantidad($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereStockMin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereStockMax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario wherePrecioCompraPonderado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario wherePrecioVentaActual($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereProductoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereTenderoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inventario whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventario extends Model
{
    protected $table = 'inventario';

    protected $appends = ['ganancia_percent','ganancia_pesos'];


    function getGananciaPercentAttribute() {
        return "Ganancia en Porcentaje";
    }

    function getGananciaPesosAttribute() {
        return "Ganancia en Pesos";
    }

}
