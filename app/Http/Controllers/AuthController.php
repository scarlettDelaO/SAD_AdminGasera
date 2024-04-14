<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        // Redireccionar según el rol del usuario
        $redirectTo = $user->role_id === 1 ? url('/vendedores') : url('/pedidos');

        return response()->json(['redirectTo' => $redirectTo]);
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

}
