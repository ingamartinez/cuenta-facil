<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $detalleCompra= DB::table('detalle_compra')
            ->join('producto_proveedor', 'detalle_compra.producto_proveedor_id', '=', 'producto_proveedor.id')
            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
            ->select(
                'detalle_compra.cantidad AS cantidad_detalle_compra',
                'producto_proveedor.precio_ofrecido AS precio',
                'producto.nombre AS nombre_producto',
                'producto.medida AS medida',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion',
                'proveedor.nombre AS nombre_proveedor'
                )
            ->where('detalle_compra.compra_id','=',$id)
            ->get();

        return $detalleCompra;
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
