<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login() {
        return view('login.login');
    }

    public function authenticate(Request $request) {
        
        //  VALIDAR DATOS Email y pass
        $validados =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //  Comprobar pass Hash
        // Si OK, login
        if (Auth::attempt($validados)) {
            // Regenero sesión
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        // Si KO, redirect back to login            
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {

    }
}
