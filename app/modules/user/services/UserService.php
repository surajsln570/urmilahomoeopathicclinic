<?php

namespace App\modules\user\services;

use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($data)
    {
        return User::create([
            'name'     => $data['name'],
            'mobile'   => $data['mobile'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => 4,
        ]);
    }
    public function update(int $id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found',
            ];
        }

        $user->update($data);

        return [
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user->fresh(),
        ];
    }
    public function getAllUsers()
    {
        return [
            'success' => true,
            'data' => User::latest()->get(),
        ];
    }

    public function deleteUser(int $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found',
            ];
        }

        $user->delete();

        return [
            'success' => true,
            'message' => 'User deleted successfully',
        ];
    }
}
