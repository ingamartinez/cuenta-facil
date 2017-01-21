<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Compra
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $tendero_id
 * @property integer $proveedor_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Compra whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Compra whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Compra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Compra whereTenderoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Compra whereProveedorId($value)
 * @mixin \Eloquent
 */
class Compra extends Model
{
    protected $table = 'compra';
}
