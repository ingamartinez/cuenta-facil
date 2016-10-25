<?php

namespace App\Http\Controllers;

use App\Models\ProductoProveedor;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Cart;
use Response;

class CarritoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Cart::instance('compra')->destroy();
//        dd(Cart::instance('compra')->content());

        $proveedores=[];
        foreach (Cart::instance('compra')->content() as $item){
            foreach ($item->options as $opciones){
                if (in_array($opciones,$proveedores )) {
                    echo "Existe";
                }else{
                    echo "No existe";
                    $proveedores[]=$opciones;
                }
//                $proveedores[]=$opciones;
            }
        }

        dd(Cart::instance('compra')->content(),$proveedores);

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

        $producto_proveedor= ProductoProveedor::findOrFail($request->id_producto_proveedor);

//        dd(Cart::instance('compra')->content(),$cartItem);

        $cant_carrito = $request->cantidad+$cartItem->qty;
//        dd($cant_carrito,$producto_proveedor->cantidad);
        if ($cant_carrito <= $producto_proveedor->cantidad){
            Cart::update($cartItem->rowId, $cant_carrito);

            return Response::json($cartItem,200);
        }else{
            return Response::json($cartItem,500);
        }
    }

    public function store(Request $request)
    {

//        Cart::instance('compra')->destroy();
//        Cart::instance()->destroy();
//        dd(Cart::instance('compra')->content(),Cart::instance()->content());
//        dd($request->id_producto_proveedor);

        $cartItem = Cart::instance('compra')->content()->where('id', $request->id_producto_proveedor)->first();

//        dd(Cart::instance('compra')->content(),$cartItem);

        if(is_null($cartItem)){
//            dd($request->all());
             return $this->addItem($request);
        }else{
            return $this->updateQuantity($request,$cartItem);
        }

    }

    private function addItem(Request $request){

        $productos_proveedores= DB::table('producto_proveedor')
            ->join('producto', 'producto_proveedor.producto_id', '=', 'producto.id')
            ->join('presentacion', 'producto.presentacion_id', '=', 'presentacion.id')
            ->join('unidad_medida', 'producto.unidad_medida_id', '=', 'unidad_medida.id')
            ->join('proveedor', 'producto_proveedor.proveedor_id', '=', 'proveedor.id')
            ->select(
                'producto_proveedor.id AS id',
                'producto_proveedor.cantidad AS cantidad',
                'producto.nombre AS nombre',
                'producto.codigo AS codigo',
                'producto_proveedor.precio_ofrecido AS precio',
                'presentacion.nombre AS presentacion',
                'producto.medida AS medida',
                'unidad_medida.nombre AS unidad_medida',
                'producto_proveedor.estado AS estado',
                'proveedor.nombre AS nombre_proveedor',
                'proveedor.id AS id_proveedor')
            ->where('producto_proveedor.id','=',$request->id_producto_proveedor)
        ->get();

//        dd($productos_proveedores);
        foreach ($productos_proveedores as $producto_proveedor){

            if ($request->cantidad <= $producto_proveedor->cantidad ){

                $cart=Cart::instance('compra')->add(array(
                        'id' => $producto_proveedor->id,
                        'name' => $producto_proveedor->nombre.' - '. $producto_proveedor->presentacion.' de '.$producto_proveedor->medida.' '.$producto_proveedor->unidad_medida,
                        'qty' => $request->cantidad,
                        'price' => $producto_proveedor->precio,
                        'options'=>[
                            'proveedor' => $producto_proveedor->id_proveedor
                        ]
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
        $cartItem= Cart::instance('compra')->get($id);
        Cart::instance('compra')->remove($id);

        return Response::json($cartItem,200);
    }
}
