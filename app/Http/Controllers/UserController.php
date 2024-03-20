<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores = User::all();
        return $vendedores;
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
        $vendedor=new User();
        $vendedor->role_id = 2;
        $vendedor->name = $request->name;
        $vendedor->lastname = $request->lastname;
        $vendedor->birthdate = $request->birthdate;
        $vendedor->phone = $request->phone;
        $vendedor->address = $request->address;
        $vendedor->nss = $request->nss; 
        $vendedor->email = $request->email;
        $vendedor->password = bcrypt($request->password); 

        $vendedor->save();
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
    public function update(Request $request)
    {
        $vendedor = User::findOrFail($request->id);

        $vendedor->name = $request->name;
        $vendedor->lastname = $request->lastname;
        $vendedor->birthdate = $request->birthdate;
        $vendedor->phone = $request->phone;
        $vendedor->address = $request->address;
        $vendedor->nss = $request->nss;
        $vendedor->email = $request->email;
    
        if (!empty($request->password)) {
            $vendedor->password = bcrypt($request->password);
        }
    
        $vendedor->save();
    
        return $vendedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor=User::destroy($request->id);
        return $vendedor;
    }
}
