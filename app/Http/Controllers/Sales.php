<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::all();
        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = new Sales();
        $sale->id_detail = $request->id_detail;
        $sale->id_customers = $request->id_customers;
        $sale->date = $request->date;
        $sale->quantity = $request->quantity;
        $sale->discount = $request->discount;
        $sale->id_pay = $request->id_pay;
        $sale->total = $request->total;

        $sale->save();
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
        $sale = Sales::findOrFail($id);

        $sale->id_detail = $request->id_detail;
        $sale->id_customers = $request->id_customers;
        $sale->date = $request->date;
        $sale->quantity = $request->quantity;
        $sale->discount = $request->discount;
        $sale->id_pay = $request->id_pay;
        $sale->total = $request->total;

        $sale->save();

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sales::destroy($id);
        return $sale;
    }
}
