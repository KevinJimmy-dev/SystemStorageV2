<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->check() && auth()->user()->status != 1) {
                return redirect()->route('login')->with('msgWarning', "Funcionário inativo!");
            }

            return redirect()->route('user.index');
        }

        return redirect()->route('login')->with('msgError', "Credenciais incorretas!");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
