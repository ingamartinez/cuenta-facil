<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
