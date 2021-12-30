<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Jobs\ForgotPasswordJob;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data = $request->validated();
        if(auth('web')->attempt($data)) {
            return redirect(route('home'));
        }
        return redirect(route('login'))->withErrors(['email' => 'Пользователь не найден!']);
    }

    public function registration(Request $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if($user) {
            auth('web')->login($user);
        }
        return redirect(route('home'));
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where($data)->first();
        $password = uniqid();
        $user->password = bcrypt($password);
        $user->save();

        dispatch(new ForgotPasswordJob($user, $password));

        return redirect(route('home'));
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect(route('home'));
    }
}
