<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();
        return $prices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = new Price();
        $price->id_detail = $request->id_detail;
        $price->previousPrice = $request->previousPrice;
        $price->changeDate = $request->changeDate;
        $price->reason = $request->reason;
        $price->actualPrice = $request->actualPrice;

        $price->save();
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
        $price = Price::findOrFail($id);

        $price->id_detail = $request->id_detail;
        $price->previousPrice = $request->previousPrice;
        $price->changeDate = $request->changeDate;
        $price->reason = $request->reason;
        $price->actualPrice = $request->actualPrice;

        $price->save();

        return $price;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::destroy($id);
        return $price;
    }
}
