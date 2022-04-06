<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Categorie,
    Product
};

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
            
            return view('user.home', [
                'userLevel' => $userLevel,
                'products' => $products,
                'categories' => $categories
            ]);

        } else{
            return view('user.home', [
                'userLevel' => $userLevel,
                'products' => $products
            ]);
        }
    }
    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function viewRegister(){

        $userLevel = User::userLevel();

        return view('user.employee.register', [
            'userLevel' => $userLevel
        ]);

    }

    public function create(Request $request){

        //dd($request->all());

        if($request->password == $request->passwordConf){

            $info = $request->only(['name', 'username', 'password']);
            $info['password'] = $request->password;
            $info['password'] = bcrypt($info['password']);
            $info['level'] = 1;
            $info['stats'] = 1;

            //dd($info);

            User::create($info);

            return redirect()->route('home.employee')->with('msg', 'Cadastro de funcionário(a) feito com sucesso!');

        } else{
            return redirect()->route('viewRegister.employee')->with('msgError', 'As senhas não coincidem!');
        }
    }

    public function list(){

        $userLevel = User::userLevel();

        $employees = User::all();

        if($userLevel['level'] == 1){
            return back()->withInput();
        }

        return view('user.employee.home', [
            'userLevel' => $userLevel,
            'employees' => $employees
        ]);
    }

    public function edit($id){

        $userLevel = User::userLevel();

        if(!$employee = User::find($id)){
            return back()->withInput();
        }

        if($employee->level != 1){
            return back()->withInput();
        }

        return view('user.employee.edit', [
            'userLevel' => $userLevel,
            'employee' => $employee
        ]);
    }

    public function update(Request $request){

        $user = User::find($request->id);

        $info = $request->only('id', 'name', 'username', 'stats');

        $user->update($info);

        return redirect()->route('home.employee')->with('msg', "Funcionário(a) editado(a) com sucesso!");
    }
}