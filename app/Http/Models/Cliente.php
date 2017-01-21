<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cliente
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereCedula($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cliente whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cliente extends Model
{
    protected $table = "cliente";
}
