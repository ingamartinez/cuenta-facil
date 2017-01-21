<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Tendero
 *
 * @property integer $id
 * @property string $nit
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $password
 * @property string $direccion
 * @property string $estado
 * @property float $lat
 * @property float $long
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereNit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereDireccion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereLong($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tendero whereRememberToken($value)
 * @mixin \Eloquent
 */
class Tendero extends Authenticatable
{
    use Notifiable;

    protected $table = 'tendero';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nit', 'nombre', 'apellido', 'email', 'direccion', 'lat', 'long'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'estado', 'remember_token',
    ];

}
