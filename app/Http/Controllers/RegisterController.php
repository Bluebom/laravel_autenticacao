<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreRegisterUserRequest as StoreRequest;

class RegisterController extends Controller
{
    /**
     * Mostrar o formulário de cadastro de usuarios
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    public function store(StoreRequest $request)
    {   
        $data = $request->only(['name','email', 'password']);
        User::create(
            $data
        );
        return redirect()->route('home');
    }
}
