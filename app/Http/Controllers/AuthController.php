<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    /*public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('AuthToken')->plainTextToken;
        $role = $user->role_id;

        return response()->json(['token' => $token, 'role' => $role], 200);
    } else {
        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }
}*/

public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            $role = $user->role_id; // Se agrega la obtención del rol del usuario
            $perfil = $user->only(['name', 'lastname', 'phone', 'address', 'nss', 'email']); // Obtener datos del perfil del usuario

            return response()->json(['token' => $token, 'role' => $role, 'perfil' => $perfil], 200);
        } else {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }


}
