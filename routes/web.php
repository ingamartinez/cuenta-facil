<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->to('log');
});

//Rutas de Login
Route::resource('log','LogController');
Route::get('logout','LogController@Logout');

//Rutas de Regitro Proveedor y Tendero
Route::post('proveedor',
    ['uses' => 'ProveedorController@store', 'as' => 'proveedor.store']);
Route::post('tendero',
    ['uses' => 'TenderoController@store', 'as' => 'tendero.store']);

//Rutas de Proveedor
Route::resource('proveedor','ProveedorController');
Route::resource('producto','ProductoController');
Route::resource('disponibilidad','DisponibilidadController');


//Rutas de Tendero
Route::resource('tendero','TenderoController');
Route::resource('vitrina','VitrinaController');
Route::resource('carrito','CarritoCompraController');





Route::get('usuario', function () {

    $proveedor = new \App\Models\Proveedor();
    $proveedor->nombre = 'Coca Cola';
    $proveedor->email= 'cc@cc.com';
    $proveedor->password= Hash::make('123');
    $proveedor->tipo= 'formal';
    $proveedor->nit= '1047473499';

    $proveedor->save();


});