<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credenciales = $request->only('email','password');
        if(Auth::attempt($credenciales)){
            $user = Auth::user();
            if($user->activo){
                return redirect()->route('dashboard');
            }else{
                Auth::logout();
                return back()->with('error', 'el usuario no se encuentra activo contacte con el administrador');
            }
        }
        return back()->with('error','los datos son incorrectos');
    }
}
