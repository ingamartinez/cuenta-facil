<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Venta
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $tendero_id
 * @property integer $cliente_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Venta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Venta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Venta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Venta whereTenderoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Venta whereClienteId($value)
 * @mixin \Eloquent
 */
class Venta extends Model
{
    protected $table = "venta";
}
