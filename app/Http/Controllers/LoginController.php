<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Success to login');;
        }

        return back()->withErrors([
            'email' => 'Email or Password not valid',
        ])->onlyInput('email');
    }

}
