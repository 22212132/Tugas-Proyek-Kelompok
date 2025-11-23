<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.user.index', compact('user'));
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'saldo' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->saldo = $request->saldo;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

}