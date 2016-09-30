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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('log','LogController');
Route::get('logout','LogController@Logout');


Route::group([
    'middleware' => 'proveedor_auth'
], function ($router) {
    require base_path('routes/custom/proveedor_routes.php');
});

Route::get('usuario', function () {

    $proveedor = new \App\Models\Proveedor();
    $proveedor->nombre = 'Coca Cola';
    $proveedor->email= 'cc@cc.com';
    $proveedor->password= Hash::make('123');
    $proveedor->tipo= 'formal';
    $proveedor->nit= '1047473499';

    $proveedor->save();


});