<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePage extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $user = $request->user();
        // $user = Auth::user();
        $user = auth()->user();
        return view('home',compact('user'));
    }
}
