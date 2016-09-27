<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use Redirect;

class Disponibilidad extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos_proveedores= DB::table('producto_proveedor')
            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
            ->select(
                'producto.id AS id_producto_global',
                'producto_proveedor.id AS id_producto_local',
                'producto_proveedor.cantidad AS cantidad',
                'producto.nombre AS nombre',
                'producto.codigo AS codigo',
                'producto_proveedor.precio_ofrecido AS precio',
                'presentacion.nombre AS presentacion',
                'producto.medida AS medida',
                'unidad_medida.nombre AS unidad_medida',
                'producto_proveedor.estado AS estado')
            ->where('proveedor.id','=',Auth::guard('web_proveedor')->user()->id)
            ->get();
//        SELECT
//            producto.id AS id_producto_global,
//            producto_proveedor.id AS id_producto_local,
//            producto_proveedor.cantidad AS cantidad,
//            producto.nombre AS nombre,
//            producto.codigo AS codigo,
//            producto_proveedor.precio_ofrecido AS precio,
//            presentacion.nombre AS presentacion,
//            producto.medida AS medida,
//            unidad_medida.nombre AS unidad_medida,
//            producto_proveedor.estado AS estado
//            FROM
//            producto_proveedor
//            INNER JOIN producto ON producto_proveedor.producto_id = producto.id
//            INNER JOIN presentacion ON producto.presentacion_id = presentacion.id
//            INNER JOIN unidad_medida ON producto.unidad_medida_id = unidad_medida.id
//            INNER JOIN proveedor ON producto_proveedor.proveedor_id = proveedor.id
//            WHERE
//            proveedor.id = 1
//        dd($productos_proveedores);

        return view('proveedores.disponibilidad.disponibilidad',compact('productos_proveedores'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
