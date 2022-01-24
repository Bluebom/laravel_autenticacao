<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutheticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function logar(AuthLoginUserRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'), $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        return redirect()->back()->withErrors([
            'email' => 'Email e/ou senha estão inválidos',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
