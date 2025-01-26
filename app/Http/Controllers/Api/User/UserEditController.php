<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Core\Users\ManagerUsers;
use Illuminate\Support\Facades\DB;


class UserEditController
{
    protected $mu;

    public function __construct()
    {
        $this->mu = new ManagerUsers();
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $params = [];
        try {
            $validationRules = $this->mu->getUserUpdateRulesValidation($id);
            $params = $request->validate($validationRules);
            $params['id'] = $id;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('error', 'Validation failed. Please check the form and try again.');
            return redirect()->route('users.index');
        }
        try {

            return DB::transaction(function () use ($request, $params) {
                $obj = $this->updateUser($params);
                if ($obj) {
                    session()->flash('notify', [
                        'type' => 'success',
                        'message' => 'The user was edited successfully.'
                    ]);
                    return redirect()->route('users.index');
                } else {
                    session()->flash('notify', [
                        'type' => 'error',
                        'message' => 'Failed to edit the user. Please try again.'
                    ]);
                    return redirect()->route('users.edit', ['userId' => $params['id']]);
                }
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('notify', [
                'type' => 'error',
                'message' => 'An unexpected error occurred. Please try again.'
            ]);
            return redirect()->route('users.edit', ['userId' => $params['id']]);
        }
    }

    public function updateUser($params)
    {
        return $this->mu->updateUser($params);
    }
}
