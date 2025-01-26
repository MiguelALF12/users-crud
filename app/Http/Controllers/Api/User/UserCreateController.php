<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Core\Users\ManagerUsers;
use Illuminate\Support\Facades\DB;

class UserCreateController
{
    protected $mu;

    public function __construct()
    {
        $this->mu = new ManagerUsers();
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $params = [];
        try {
            $validationRules = $this->mu->getUserCreationRulesValidation();
            $params = $request->validate($validationRules);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('error', 'Validation failed. Please check the form and try again.');
            return redirect()->route('users.create');
        }
        try {

            return DB::transaction(function () use ($request, $params) {

                $obj = $this->createUser($params);
                if ($obj) {
                    session()->flash('notify', [
                        'type' => 'success',
                        'message' => 'The user was created successfully.'
                    ]);

                    return redirect()->route('users.index');
                } else {
                    session()->flash('notify', [
                        'type' => 'error',
                        'message' => 'Failed to create the user. Please try again.'
                    ]);
                    return redirect()->route('users.create');
                }
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('notify', [
                'type' => 'error',
                'message' => 'An unexpected error occurred. Please try again.'
            ]);
            return redirect()->route('users.create');
        }
    }

    public function createUser($params)
    {
        return $this->mu->createUser($params);
    }
}
