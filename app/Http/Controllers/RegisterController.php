<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $classes = Kelas::all(); // Ambil semua data kelas
        return view('auth.register', compact('classes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'kelas' => ['required', 'exists:classes,id'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'class_id' => $request->kelas,
            'password' => Hash::make($request->password),
            'saldo' => 0, 
        ]);

        return redirect()->route('login')->with('success', 'Success creating account');
    }
}