<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    public function index(){
        return view('user.login');
    }

    public function auth(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            if(auth()->check() && auth()->user()->level == 1){
                return redirect('/funcionario');

            } elseif(auth()->check() && auth()->user()->level == 2){
                return redirect('/cordenador');

            } elseif(auth()->check() && auth()->user()->level == 3){
                return redirect('/admin');
            }
        } else{
            dd('Você não está logado!');
        }
    }
    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect('/');
    }
}