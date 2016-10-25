<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class InventarioController extends Controller
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
    public function show2($id)
    {
        $inventario= DB::table('inventario')
            ->join('tendero', 'inventario.tendero_id', '=', 'tendero.id')
            ->join('producto', 'inventario.producto_id', '=', 'producto.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->select(
                'inventario.id',
                'inventario.stock_min',
                'inventario.stock_max',
                'inventario.precio_venta_actual',
                'inventario.estado',
                'inventario.cantidad',
                'producto.nombre',
                'producto.medida',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion'
            )
            ->where('inventario.id','=',$id)
        ->get();

        return $inventario;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $inventario= Inventario::findOrFail($id);

        return $inventario;
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
        $inventario=Inventario::findOrFail($id);
        $inventario->stock_min              = $request->stock_minimo;
        $inventario->stock_max              = $request->stock_maximo;
        $inventario->precio_venta_actual    = $request->precio_venta;
        $inventario->estado                 = $request->estado;

        $inventario->save();

        return response()->json($inventario,200);
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
