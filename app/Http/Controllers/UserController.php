<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    public function index(){
        return view('users.login');
    }

    public function auth(Request $request){
        if(Auth::attempt(['user' => $request->user, 'password' => $request->password])){
            dd('Logou');
        } else{
            dd('Não logou');
        }
    }
}