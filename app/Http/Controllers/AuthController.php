<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegister()
    {
        return View::make('auth.register');
    }
    public function showLogin()
    {
        return View::make('auth.login');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->authService->registerUser($data);
        Auth::login($user);
        Session::flash('success', 'Welcome');
        return Redirect::route('dashboard');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return Redirect::route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('login');
    }

}
