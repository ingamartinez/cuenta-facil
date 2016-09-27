<?php
/**
 * Created by PhpStorm.
 * User: ingam
 * Date: 27/09/2016
 * Time: 12:37 PM
 */

Route::get('/', function () {
    return view('proveedores.index.index');
});

Route::get('disponibilidad','Disponibilidad@index');
