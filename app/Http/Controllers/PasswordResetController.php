<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordResetRequest as ResetRequest;
use App\Http\Requests\PasswordUpdateRequest as UpdateRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class PasswordResetController extends Controller
{
    public function request()
    {
        return view('auth.passwords.email');
    }
    public function email(ResetRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT 
                ? redirect()->back()->with(['status' => __($status)])
                : redirect()->back()->withErrors(['email' => __($status)]);
    }

    public function reset()
    {
        return view('auth.passwords.reset');
    }

    public function update(UpdateRequest $request)
    {
        $status = Password::reset(
            $request->except('_token'),
            function($user, $password){
                $user->forceFill([
                    'password' => $password])->setRememberToken(Str::random(60));
                $user->save();
                
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('home')
                : redirect()->back()->withErrors(['email' => __($status)]);
    }
}
