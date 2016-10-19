<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
