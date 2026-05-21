<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function registerUser(array $data): User
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = User::ROLE_MEMBER;
        $user->save();
        return $user;
    }

    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

}
