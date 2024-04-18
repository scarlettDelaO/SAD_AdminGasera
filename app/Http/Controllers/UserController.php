<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;

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
        $vendedor = User::findOrFail($id);
        return response()->json($vendedor);
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
        $vendedor = User::findOrFail($id);

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
        $vendedor = User::destroy($id);
        return $vendedor;
    }

    public function perfil(Request $request)
    {
        // Obtener el usuario autenticado
        $user = $request->user();

        // Retornar los datos del perfil del usuario
        return response()->json([
            'name' => $user->name,
            'lastname' => $user->lastname,
            'phone' => $user->phone,
            'address' => $user->address,
            'nss' => $user->nss,
            'email' => $user->email,
            // No devuelvas la contraseña por razones de seguridad
        ]);
    }
}
