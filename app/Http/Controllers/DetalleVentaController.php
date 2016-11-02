<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;

class DetalleVentaController extends Controller
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
        $detalleVenta= DB::table('detalle_venta')
            ->join('inventario', 'detalle_venta.inventario_id', '=', 'inventario.id')
            ->join('producto', 'inventario.producto_id', '=', 'producto.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')

            ->select(
                'detalle_venta.cantidad AS cantidad_detalle_venta',
                'detalle_venta.precio AS precio',
                'producto.nombre AS nombre_producto',
                'producto.medida AS medida',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion'
            )
            ->where('detalle_venta.venta_id','=',$id)
        ->get();

        return $detalleVenta;
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
