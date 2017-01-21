<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Proveedor
 *
 * @property integer $id
 * @property string $nit
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property string $tipo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereNit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereTipo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Proveedor whereRememberToken($value)
 * @mixin \Eloquent
 */
class Proveedor extends Authenticatable
{
    use Notifiable;
    protected $table = 'proveedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nit', 'nombre', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tipo', 'password', 'tipo', 'remember_token',
    ];
}
