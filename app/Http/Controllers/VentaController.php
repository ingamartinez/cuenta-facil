<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Venta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Auth;
use DB;
use Response;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $ventas= DB::table('venta')
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->select(
                'venta.id',
                'cliente.nombre',
                'venta.created_at'
            )
            ->where('venta.tendero_id','=',Auth::guard('web_tendero')->user()->id)
            ->get();
        return view('tenderos.venta.venta',compact('ventas'));
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
        $venta = new Venta();
        $venta->tendero_id=Auth::guard('web_tendero')->user()->id;
        $venta->cliente_id=1;
        $venta->save();

        foreach (Cart::instance('venta')->content() as $cartItem){
//            $id[]=$cartItem->id;
            $detalle_venta= new DetalleVenta();
            $detalle_venta->venta_id =      $venta->id;
            $detalle_venta->inventario_id=  $cartItem->id;
            $detalle_venta->cantidad=       $cartItem->qty;
            $detalle_venta->precio=         $cartItem->price;
            $detalle_venta->save();

            $inventario= Inventario::findOrFail($cartItem->id);
            $inventario->cantidad= (int) $inventario->cantidad - (int)$cartItem->qty;
            $inventario->save();

        }

        Cart::instance('venta')->destroy();


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
