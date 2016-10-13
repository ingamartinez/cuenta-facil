<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use Redirect;
use Response;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos= DB::table('producto')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->select(
                'producto.id AS id',
                'producto.codigo AS codigo',
                'producto.nombre AS nombre',
                'presentacion.nombre AS presentacion',
                'producto.medida AS medida',
                'unidad_medida.nombre AS unidad_medida'
                )
        ->get();

        $presentaciones= DB::table('presentacion')
            ->select(
                'presentacion.id AS id',
                'presentacion.nombre AS nombre'
            )
        ->get();

        $unidades_medidas= DB::table('unidad_medida')
            ->select(
                'unidad_medida.id AS id',
                'unidad_medida.nombre AS nombre'
            )
            ->get();


        return view('proveedores.producto.producto',compact('productos','presentaciones','unidades_medidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $producto=new Producto($request->all());
        $producto->presentacion_id=$request->presentacion;
        $producto->unidad_medida_id=$request->unidad_medida;

        $producto->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto= Producto::findOrFail($id);

        return Response::json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
