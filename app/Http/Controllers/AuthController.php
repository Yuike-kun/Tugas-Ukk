<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');  
    }

    public function loginProcess(Request $request) : RedirectResponse {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validate();

        if (Auth::attempt($valid->safe()->only(['username','password']))) {
            $request->session()->regenerate();
            return to_route('login.view');
        }
        
        return back()->withErrors([
            'username' => 'Username atau Password Salah, Silahkan Coba Lagi'
        ])->onlyInput('username');
    }

    public function logout(Request $request) : RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login.view');
    }
}
