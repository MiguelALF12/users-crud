<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;

class UserDeleteController
{

    public function destroy($id)
    {
        // Logic to delete a user
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
