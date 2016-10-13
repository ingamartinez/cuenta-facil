<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/productos', function (Request $request) {
//    $producto=\App\Models\Producto::all();
//    return $producto->toJson();
//    return response()->json([
//
//        ["id"=>"United Arab Emirates","text"=>"AE"],
//        ["id"=>"United Kingdom","text"=>"UK"],
//        ["id"=>"United States","text"=>"US"]
//
//    ]);

    $term = ($request->term) ? : '  ';
    $v = 'My Value';
    $r = ($v) ?: 'No Value'; // $r is set to 'My Value' because $v is evaluated to TRUE
//    $tags = \App\Models\Producto::where('nombre', 'like', $term.'%')->get();

    $tags = DB::table('producto')
        ->where('nombre', 'like', '%'.$term.'%')
        ->get();

    $valid_tags = [];
    foreach ($tags as $id => $tag) {
        $valid_tags[] = ['id' => $id, 'text' => $tag->nombre];
    }
    return \Response::json($valid_tags);

});