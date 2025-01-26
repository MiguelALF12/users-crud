<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;

class UserListController
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
