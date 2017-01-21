<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Presentacion
 *
 * @property integer $id
 * @property string $nombre
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Presentacion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Presentacion whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Presentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Presentacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Presentacion extends Model
{
    protected $table = 'presentacion';
}
