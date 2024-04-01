<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Order::with(['customer', 'status'])->get();
        return response()->json($pedidos);
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
        $pedido=new Order();
        $pedido->customer_id = $request->customer_id;
        $pedido->date = $request->date;
        $pedido->quantity = $request->quantity;
        $pedido->address = $request->address;
        $pedido->statu_id = $request->statu_id;

        $pedido->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Order::with(['customer', 'status'])->findOrFail($id);
        return response()->json($pedido);
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
        $pedido = Order::findOrFail($id);
        $pedido->customer_id = $request->customer_id;
        $pedido->date = $request->date;
        $pedido->quantity = $request->quantity;
        $pedido->address = $request->address;
        $pedido->statu_id = $request->statu_id;

        $pedido->save();
    
        return $pedido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Order::destroy($id);
        return $pedido;

    }
}
