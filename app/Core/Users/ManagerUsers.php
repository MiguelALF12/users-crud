<?php

namespace App\Core\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| ManagerUsers
|--------------------------------------------------------------------------
|
| Permite definir la logica a utilizar dentro de los controladores conectando los metodos del modelo User
*/

class ManagerUsers
{

    public function createUser($userData)
    {

        $user = new User();
        $user->name = $userData['name'];
        $user->last_name = $userData['lastname'];
        $user->email = $userData['email'];
        $user->phone_number = $userData['phone'];
        $user->password = Hash::make($userData['password']);
        $user->save();

        return $user;
    }

    public function deleteUser($userId)
    {
        // Logic to delete a user
        $user = User::find($userId);
        $user->delete();
    }

    public function updateUser($userData)
    {
        // Logic to update a user
        // Example: User::where('id', $userId)->update($userData);
        $user = User::find($userData['id']);
        $user->name = $userData['name'];
        $user->last_name = $userData['lastname'];
        $user->email = $userData['email'];
        $user->phone_number = $userData['phone'];
        if (!empty($userData['password'])) {
            $user->password = Hash::make($userData['password']);
        }
        $user->save();

        return $user;
    }

    public function getUserCreationRulesValidation()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|confirmed',
        ];

        return $rules;
    }

    public function getUserUpdateRulesValidation($userId)
    {
        $rules = [
            'name' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            // $userId is used to ignore the current user's email when validating
            'email' => 'sometimes|email|unique:users,email,' . $userId,
            'phone' => 'sometimes|string|max:15',
            'password' => 'nullable|string|confirmed',
        ];

        return $rules;
    }
}
