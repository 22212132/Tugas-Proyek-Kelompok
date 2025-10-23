<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view ('auth.login');
    }


    public function login(Request $request){
        $request -> validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required','string']
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email or Password not valid',
        ])->onlyInput('email');
    }

}
