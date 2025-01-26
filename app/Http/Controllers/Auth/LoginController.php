<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Core\Auth\ManagerAuth;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{

    protected $ma;

    public function __construct()
    {
        $this->ma = new ManagerAuth();
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $params = [];
        try {
            $validationRules = $this->ma->getUserLoginValidationRules();
            $params = $request->validate($validationRules);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        try {
            $result = $this->ma->login($params);
            if ($result) {
                $request->session()->regenerate();
                return redirect()->intended('/users');
            } else {
                return back()->withErrors('The provided credentials do not match our records.')->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = $this->ma->logout($request);
            if ($result) {
                return redirect('/');
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
