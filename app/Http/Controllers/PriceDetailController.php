<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceDetail;

class PriceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalles = PriceDetail::all();
        return $detalles;

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
        $detalle = new PriceDetail();
        $detalle->netPrice = $request->netPrice;
        $detalle->iva = $request->iva;
        $detalle->salePrice = $request->salePrice;
        $detalle->aggregate = $request->aggregate;

        $detalle->save();
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
        $detalle = PriceDetail::findOrFail($id);

        $detalle->netPrice = $request->netPrice;
        $detalle->iva = $request->iva;
        $detalle->salePrice = $request->salePrice;
        $detalle->aggregate = $request->aggregate;

        $detalle->save();

        return $detalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle = PriceDetail::destroy($id);
        return $detalle;
    }
}
