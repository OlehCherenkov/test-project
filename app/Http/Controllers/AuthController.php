<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required'],
        ]);
        if(auth('web')->attempt($data)) {
            return redirect(route('home'));
        }
        return redirect(route('login'))->withErrors(['email' => 'Пользователь не найден!']);
    }

    public function registration(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if($user) {
            auth('web')->login($user);
        }
        return redirect(route('home'));
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect(route('home'));
    }
}
