<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;

class ProveedorInformalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('producto')
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

        $presentaciones = DB::table('presentacion')
            ->select(
                'presentacion.id AS id',
                'presentacion.nombre AS nombre'
            )
            ->get();

        $unidades_medidas = DB::table('unidad_medida')
            ->select(
                'unidad_medida.id AS id',
                'unidad_medida.nombre AS nombre'
            )
            ->get();

        $proveedoresInformales = Proveedor::where('tipo', '=', 'informal')->get();

        return view('tenderos.proveedor.proveedor', compact('proveedoresInformales', 'productos', 'presentaciones', 'unidades_medidas'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor($request->all());

        $proveedor->tipo = 'informal';

        $proveedor->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        if ($proveedor->tipo === "formal") {
            abort(404);
        }

//        $productos_proveedor_informal= DB::table('producto_proveedor')
//            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
//            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
//            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
//            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
//
//            ->select(
//                'producto_proveedor.id AS id',
//                'producto.id AS codigo',
//                'producto.medida AS medida',
//                'producto.nombre AS nombre',
//                'producto_proveedor.cantidad AS cantidad',
//                'producto_proveedor.precio_ofrecido AS precio',
//                'presentacion.nombre AS presentacion',
//                'unidad_medida.nombre AS unidad_medida',
//                'proveedor.nombre AS proveedor'
//
//            )
//            ->where('proveedor.id','=',$id)
//            ->where('proveedor.tipo','=','informal')
//        ->get();

        $productos_proveedores = DB::table('producto_proveedor')
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
            ->where('proveedor.id', '=', $id)
            ->get();

        $productos = DB::table('producto')
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
            ->whereNotIn('producto.id', function ($query) use ($id) {
                $query->select('producto_proveedor.producto_id')
                    ->from('producto_proveedor')
                    ->whereRaw('producto_proveedor.proveedor_id = ' . $id);
            })
            ->orderBy('nombre', 'asc')
            ->get();

        $productos2 = DB::table('producto')
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

        return view('tenderos.proveedor.productos-proveedor', compact('productos_proveedores', 'productos', 'productos2'))->with('id', $id);
    }

    public function show2($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return response()->json($proveedor);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->nit = $request->nit;


        $proveedor->save();

        return response()->json($proveedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
