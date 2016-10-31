<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
class VitrinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $inventario= DB::table('inventario')
            ->join('producto', 'inventario.producto_id', '=', 'producto.id')
            ->join('tendero', 'inventario.tendero_id', '=', 'tendero.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->select(
                'inventario.id AS id',
                'inventario.cantidad AS cantidad',
                'inventario.stock_min AS stock_min',
                'inventario.stock_max AS stock_max',
                'inventario.precio_compra_ponderado AS precio_compra_ponderado',
                'inventario.precio_venta_actual AS precio_venta_actual',
                'inventario.estado AS estado',
                'producto.nombre AS nombre',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion',
                'producto.codigo AS codigo',
                'producto.medida AS medida'
            )
            ->where('tendero.id','=',Auth::guard('web_tendero')->user()->id)
        ->get();

        foreach ($inventario as $inv){
            if($inv->precio_venta_actual!=0){
                $inv->ganancia_percent = "";
                $precioVenta = $inv->precio_venta_actual;
                $precioCompra = $inv->precio_compra_ponderado;

                $diferencia = $precioVenta-$precioCompra;
                $porcentaje = ($diferencia/$precioCompra)*100;

                $porcentaje = round($porcentaje,2);

                $inv->ganancia_percent = $porcentaje;
            }
        }

        $productos_proveedores= DB::table('producto_proveedor')
            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->select(
                'producto_proveedor.id AS id',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion',
                'producto.codigo AS codigo',
                'producto.nombre AS nombre',
                'producto.medida AS medida',
                'producto.iva AS iva',
                'producto_proveedor.cantidad AS cantidad_disponible',
                'producto_proveedor.precio_ofrecido AS precio_ofrecido',
                'proveedor.nit AS nit',
                'proveedor.nombre AS nombre_proveedor'

            )
            ->where('producto_proveedor.estado','=','disponible')
        ->get();


        return view('tenderos.vitrina.vitrina',compact('inventario','productos_proveedores'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos_proveedores= DB::table('producto_proveedor')
            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->select(
                'producto_proveedor.id AS id',
                'unidad_medida.nombre AS unidad_medida',
                'presentacion.nombre AS presentacion',
                'producto.codigo AS codigo',
                'producto.nombre AS nombre',
                'producto.medida AS medida',
                'producto.iva AS iva',
                'producto_proveedor.cantidad AS cantidad_disponible',
                'producto_proveedor.precio_ofrecido AS precio_ofrecido',
                'producto_proveedor.estado AS estado',
                'proveedor.nit AS nit',
                'proveedor.nombre AS nombre_proveedor'

            )
            ->where('producto_proveedor.id','=',$id)
        ->get();
        return $productos_proveedores;
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
        dd($request->all());
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
