<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Users\ManagerUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{

    protected $mu;

    public function __construct()
    {
        $this->mu = new ManagerUsers();
    }

    public function showRegisterForm()
    {
        return view('auth.signup');
    }


    public function register(Request $request)
    {

        $params = [];
        try {
            $validationRules = $this->mu->getUserCreationRulesValidation();
            $params = $request->validate($validationRules);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }

        try {
            return DB::transaction(function () use ($request, $params) {
                $obj = $this->createUser($params);
                if ($obj) {
                    Auth::login($obj);
                    return redirect()->route('users.index');
                } else {
                    return back()->withErrors('An error occurred during the registration process. Please try again later.')->withInput();
                }
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back()->withErrors('An error occurred during the registration process. Please try again later.')->withInput();
        }
    }

    public function createUser($params)
    {
        return $this->mu->createUser($params);
    }
}
