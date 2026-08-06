<?php

namespace App\Modules\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Models\User;

class AuthService
{
    public function register($data)
    {
        return User::create([
            'name'     => $data['name'],
            'mobile'   => $data['mobile'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => 4,
        ]);
    }

    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return [
                'success' => false,
                'message' => 'Invalid email or password',
            ];
        }

        // Store user in session (for web/blade auth)
        Auth::login($user);

        return [
            'success' => true,
            'user'    => $user,
        ];
    }

    public function logout(): void
    {
        Auth::logout();
    }
}