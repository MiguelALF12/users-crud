<?php

namespace App\Core\Auth;

use Illuminate\Support\Facades\Auth;

class ManagerAuth
{

    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return true;
    }

    public function getUserLoginValidationRules()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        return $rules;
    }
}
