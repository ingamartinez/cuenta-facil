<?php
/**
 * Created by PhpStorm.
 * User: ingam
 * Date: 27/09/2016
 * Time: 12:37 PM
 */

Route::get('/', function () {
    return "hola tendero";
});

//Route::get('disponibilidad','DisponibilidadController@index');
//
//Route::post('dispnibilidad',
//    ['uses' => 'DisponibilidadController@store', 'as' => 'disponibilidad.store']);

Route::resource('producto','ProductoController');

Route::resource('disponibilidad','DisponibilidadController');
