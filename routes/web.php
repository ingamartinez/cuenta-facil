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
Route::resource('carrito-compra','CarritoCompraController');
Route::resource('carrito-venta','CarritoVentaController');
Route::resource('compras','CompraController');
Route::resource('detalle-compra','DetalleCompraController');
Route::resource('ventas','VentaController');
Route::resource('detalle-venta','DetalleVentaController');
Route::resource('inventario','InventarioController');
Route::resource('proveedor-informal','ProveedorInformalController');

Route::get('inventario2/{id}',
    ['uses' => 'InventarioController@show2', 'as' => 'inventario2.show']);

Route::post('disponibilidad2/{id}',
    ['uses' => 'DisponibilidadController@store2', 'as' => 'disponibilidad2.store']);

Route::get('proveedor-informal2/{id}',
    ['uses' => 'ProveedorInformalController@show2', 'as' => 'show2.store']);

Route::get('consultar-venta',
    ['uses' => 'VentaController@consultarVenta', 'as' => 'consultar-venta']);

Route::get('consultar-compra',
    ['uses' => 'CompraController@consultarCompra', 'as' => 'consultar-compra']);


Route::get('usuario', function () {

    $proveedor = new \App\Models\Proveedor();
    $proveedor->nombre = 'Coca Cola';
    $proveedor->email= 'cc@cc.com';
    $proveedor->password= Hash::make('123');
    $proveedor->tipo= 'formal';
    $proveedor->nit= '1047473499';

    $proveedor->save();


});