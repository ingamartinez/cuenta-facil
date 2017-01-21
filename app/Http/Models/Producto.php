<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Producto
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property float $medida
 * @property float $iva
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $presentacion_id
 * @property integer $unidad_medida_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereCodigo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereMedida($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereIva($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto wherePresentacionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Producto whereUnidadMedidaId($value)
 * @mixin \Eloquent
 */
class Producto extends Model
{
    protected $table = 'producto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nombre', 'medida', 'presentacion_id', 'unidad_medida_id', 'iva'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tipo', 'password', 'remember_token',
    ];
}
