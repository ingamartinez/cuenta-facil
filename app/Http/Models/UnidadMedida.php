<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UnidadMedida
 *
 * @property integer $id
 * @property string $nombre
 * @property string $contraccion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UnidadMedida whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UnidadMedida whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UnidadMedida whereContraccion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UnidadMedida whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UnidadMedida whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UnidadMedida extends Model
{
    protected $table = 'unidad_medida';
}
