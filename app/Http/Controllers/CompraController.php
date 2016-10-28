<?php

namespace App\Http\Controllers;


use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Inventario;
use App\Models\ProductoProveedor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Auth;
use DB;
use Response;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::where('tendero_id', Auth::guard('web_tendero')->user()->id)->get();
        return view('tenderos.compra.compra',compact('compras'));
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
        $proveedores=[];
        foreach (Cart::instance('compra')->content() as $item){
            foreach ($item->options as $opciones){
                if (in_array($opciones,$proveedores )) {
//                    echo "Existe";
                }else{
//                    echo "No existe";
                    $proveedores[]=$opciones;
                }
//                $proveedores[]=$opciones;
            }
        }
        $compras=[];

        foreach ($proveedores as $proveedor){
            $compra = new Compra();
            $compra->proveedor_id=$proveedor;
            $compra->tendero_id=Auth::guard('web_tendero')->user()->id;
            $compra->save();

            foreach (Cart::instance('compra')->content() as $cartItem) {
                foreach ($cartItem->options as $opciones){
                    if ($opciones===$proveedor ) {

                        $detalle_compra = new DetalleCompra();
                        $detalle_compra->compra_id =            $compra->id;
                        $detalle_compra->producto_proveedor_id= $cartItem->id;
                        $detalle_compra->cantidad=              $cartItem->qty;
                        $detalle_compra->save();

                        $producto_proveedor= ProductoProveedor::findOrFail($cartItem->id);
                        $producto_proveedor->cantidad= (int) $producto_proveedor->cantidad - (int)$cartItem->qty;
                        $producto_proveedor->save();


                        $articuloInventario = Inventario::where('producto_id','=',$producto_proveedor->producto_id)
                                                        ->where('tendero_id','=',Auth::guard('web_tendero')->user()->id)->first();

                        if(empty($articuloInventario)){
                            $nuevoArticuloInventario = new Inventario();
                            $nuevoArticuloInventario->cantidad = $cartItem->qty;
                            $nuevoArticuloInventario->precio_compra_ponderado = (float)$producto_proveedor->precio_ofrecido;
                            $nuevoArticuloInventario->producto_id = $producto_proveedor->producto_id;
                            $nuevoArticuloInventario->tendero_id=Auth::guard('web_tendero')->user()->id;
                            $nuevoArticuloInventario->estado='disponible';
                            $nuevoArticuloInventario->stock_min=1;
                            $nuevoArticuloInventario->save();
                        }else{

                            $cantidadInventario=(float)$articuloInventario->cantidad;
                            $cantidadIngresada=(float)$cartItem->qty;

                            $precioCompraInventario=(float)$articuloInventario->precio_compra_ponderado;
                            $precioCompraIngresado=(float)$producto_proveedor->precio_ofrecido;

                            $articuloInventario->cantidad = (int)$articuloInventario->cantidad + (int)$cartItem->qty;

                            $articuloInventario->precio_compra_ponderado=($cantidadInventario*$precioCompraInventario+$cantidadIngresada*$precioCompraIngresado)/($cantidadIngresada+$cantidadInventario);
                            $articuloInventario->save();
                        }
                    }else{

                    }
                }
            }
        }
        Cart::instance('compra')->destroy();


        return Response::json($cartItem,200);


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
