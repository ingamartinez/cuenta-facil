<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Response;
use DB;

class CarritoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Cart::instance('venta')->content());
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
    private function updateQuantity($request,$cartItem){

        $producto= Inventario::findOrFail($request->id_inventario);

//        dd(Cart::instance('venta')->content(),$cartItem);

        $cant_carrito = $request->cantidad+$cartItem->qty;
//        dd($cant_carrito,$producto->cantidad);
        if ($cant_carrito <= $producto->cantidad){
            Cart::update($cartItem->rowId, $cant_carrito);

            return Response::json($cartItem,200);
        }else{
            return Response::json($cartItem,500);
        }
    }

    public function store(Request $request)
    {

//        Cart::instance('venta')->destroy();
//        Cart::instance()->destroy();
//        dd(Cart::instance('venta')->content(),Cart::instance()->content());
//        dd($request->all());

        $cartItem = Cart::instance('venta')->content()->where('id', $request->id_inventario)->first();

//        dd(Cart::instance('venta')->content(),$cartItem);

        if(is_null($cartItem)){
//            dd($request->all());
            return $this->addItem($request);
        }else{
            return $this->updateQuantity($request,$cartItem);
        }

    }

    private function addItem(Request $request){

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
            ->where('inventario.id','=',$request->id_inventario)
            ->get();

//        dd($productos_proveedores);
        foreach ($inventario as $producto){

            if ($request->cantidad <= $producto->cantidad ){

                $cart=Cart::instance('venta')->add(array(
                        'id' => $producto->id,
                        'name' => $producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida,
                        'qty' => $request->cantidad,
                        'price' => $producto->precio_venta_actual
                    )
                );


                return Response::json($cart,200);
            }else{
                return Response::json('La cantidad se excede',500);
            }
        }
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
        $cartItem= Cart::instance('venta')->get($id);
        Cart::instance('venta')->remove($id);

        return Response::json($cartItem,200);
    }
}
