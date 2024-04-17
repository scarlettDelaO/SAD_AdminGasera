<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\PaymentMethod;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Sale::with(['customer', 'payment'])->get();
        return response()->json($ventas);
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
        $venta = new Sale();
        $venta->customer_id = $request->customer_id;
        $venta->detail_id = 1;
        $venta->date = $request->date;
        $venta->quantity = $request->quantity;
        $venta->discount = $request->discount;
        $venta->pay_id = $request->pay_id;
        $venta->total = $request->total;

        $venta->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Sale::with(['customer', 'payment'])->findOrFail($id);
        return response()->json($venta);
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
        $venta = Sale::findOrFail($id);

        $venta->customer_id = $request->customer_id;
        $venta->detail_id = 1;
        $venta->date = $request->date;
        $venta->quantity = $request->quantity;
        $venta->discount = $request->discount;
        $venta->pay_id = $request->pay_id;
        $venta->total = $request->total;

        $venta->save();

        return $venta;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Sale::destroy($id);
        return $venta;

    }
}
