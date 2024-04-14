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
        $priceDetails = PriceDetail::all();
        return $priceDetails;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $priceDetail = new PriceDetail();
        $priceDetail->id_detail = $request->id_detail;
        $priceDetail->previousPrice = $request->previousPrice;
        $priceDetail->changeDate = $request->changeDate;
        $priceDetail->reason = $request->reason;
        $priceDetail->actualPrice = $request->actualPrice;

        $priceDetail->save();
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
        $priceDetail = PriceDetail::findOrFail($id);

        $priceDetail->id_detail = $request->id_detail;
        $priceDetail->previousPrice = $request->previousPrice;
        $priceDetail->changeDate = $request->changeDate;
        $priceDetail->reason = $request->reason;
        $priceDetail->actualPrice = $request->actualPrice;

        $priceDetail->save();

        return $priceDetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceDetail = PriceDetail::destroy($id);
        return $priceDetail;
    }
}
