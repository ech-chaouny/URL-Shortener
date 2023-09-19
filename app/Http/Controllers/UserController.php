<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('auth.register');
    }
    public function login()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->login($user);
        return redirect('/');
    }
    public function auth(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect('/');
        } else {
            return redirect()->route('login')->with([
                'error' => 'inscription please'
            ]);
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
