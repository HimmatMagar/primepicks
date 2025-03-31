<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleAuthController extends Controller
{
    public function signupPage() {
        return view('log/signup');
    }

    public function signinPage() {
        return view('log/signin');
    }

    public function signup(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // dd($request->all());
        User::create($request->all());

        return redirect()->route('signinPage');
    }

    public function signin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    public function signout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
