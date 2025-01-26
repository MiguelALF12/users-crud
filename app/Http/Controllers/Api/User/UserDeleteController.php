<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Core\Users\ManagerUsers;
use Illuminate\Support\Facades\DB;


class UserDeleteController
{
    protected $mu;

    public function __construct()
    {
        $this->mu = new ManagerUsers();
    }
    public function destroy(Request $request, $id)
    {
        try {
            if (is_null($id) && !is_numeric($id)) {
                session()->flash('error', 'Invalid user ID.');
                return back();
            }
            $params = [
                'id' => $id
            ];
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('error', 'Validation failed. Please check the form and try again.');
            return redirect()->route('users.index');
        }

        try {
            return DB::transaction(function () use ($request, $params) {
                $objRemoved = $this->deleteUser($params);
                if ($objRemoved) {
                    session()->flash('notify', [
                        'type' => 'success',
                        'message' => 'The user was deleted successfully.'
                    ]);
                } else {
                    session()->flash('notify', [
                        'type' => 'error',
                        'message' => 'Failed to delete the user. Please try again.'
                    ]);
                }
                return redirect()->route('users.index');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            session()->flash('notify', [
                'type' => 'error',
                'message' => 'Failed to delete the user. Please try again.'
            ]);
            return redirect()->route('users.index');
        }
    }

    public function deleteUser($params)
    {
        return $this->mu->deleteUser($params['id']);
    }
}
