<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Product;

class UserController extends Controller{

    public function index(){
        return view('user.login');
    }

    public function auth(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            if(auth()->check() && auth()->user()->stats == 1){
                return redirect()->route('home.user'); 

            } else{
                return redirect()->route('login')->with('msgWarning', "Usuário inativo!"); 
            }
        } else{
            return redirect()->route('login')->with('msgError', "Credenciais incorretas!"); 
        }
    }

    public function home(){

        $userLevel = User::userLevel();

        $products = Product::all()->toArray();

        $categorie_id = [];
        if($products){
            foreach($products as $product){
                    $categorie_id[] = $product['categorie_id']; 
                }

                for($i = 0; $i < count($products); $i++){
                    $categories[] = Categorie::where('id', $categorie_id[$i])->first()->toArray();   
                }
        }

        return view('user.home', [
            'userLevel' => $userLevel,
            'products' => $products,
            'categories' => $categories
        ]);
    }
    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}