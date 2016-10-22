<?php

namespace App\Http\Controllers;

use App\Models\ProductoProveedor;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use Redirect;
use Response;

class DisponibilidadController extends Controller
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
            ->whereNotIn('producto.id',function ($query) {
                $query->select('producto_proveedor.producto_id')
                    ->from('producto_proveedor')
                    ->whereRaw('producto_proveedor.proveedor_id = '.Auth::guard('web_proveedor')->user()->id);
            })
            ->orderBy('nombre', 'asc')
        ->get();

        $productos2= DB::table('producto')
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
            ->orderBy('nombre', 'asc')
        ->get();

        return view('proveedores.disponibilidad.disponibilidad',compact('productos_proveedores','productos','productos2'));
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
        $producto_proveedor=new ProductoProveedor($request->all());

        $producto_proveedor->proveedor_id=Auth::guard('web_proveedor')->user()->id;
        $producto_proveedor->producto_id=$request->producto;

        $producto_proveedor->save();

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
        $producto= ProductoProveedor::findOrFail($id);

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
        $producto_proveedor = ProductoProveedor::findOrFail($id);
        $producto_proveedor->cantidad= $request->cantidad;
        $producto_proveedor->precio_ofrecido= $request->precio_ofrecido;
        $producto_proveedor->estado= $request->estado;

        $producto_proveedor->save();

        return Response::json('ok',200);
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
