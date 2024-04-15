<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Sale::all();
        return $ventas;
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
        $venta->id_detail = $request->id_detail;
        $venta->id_customers = $request->id_customers;
        $venta->date = $request->date;
        $venta->quantity = $request->quantity;
        $venta->discount = $request->discount;
        $venta->id_pay = $request->id_pay;
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
        $venta = Sale::findOrFail($id);

        $venta->id_detail = $request->id_detail;
        $venta->id_customers = $request->id_customers;
        $venta->date = $request->date;
        $venta->quantity = $request->quantity;
        $venta->discount = $request->discount;
        $venta->id_pay = $request->id_pay;
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
