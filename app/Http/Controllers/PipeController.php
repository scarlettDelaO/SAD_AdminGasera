<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pipe;

class PipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pipas = Pipe::with(['user'])->get();
        return response()->json($pipas);
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
        $pipa=new Pipe();
        $pipa->salesperson_id = $request->salesperson_id;
        $pipa->capacity = $request->capacity;
        $pipa->niv = $request->niv;
        $pipa->brand = $request->brand;
        $pipa->model = $request->model;

        $pipa->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pipa = Pipe::with(['users'])->findOrFail($id);
        return response()->json($pipa);
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
        $pipa=Pipe::findOrFail($id);
        $pipa->salesperson_id = $request->salesperson_id;
        $pipa->capacity = $request->capacity;
        $pipa->niv = $request->niv;
        $pipa->brand = $request->brand;
        $pipa->model = $request->model;

        $pipa->save();
        return $pipa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pipa = Pipe::destroy($id);
        return $pipa;
    }
}
