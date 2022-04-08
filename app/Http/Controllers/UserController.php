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

        if($request->password == $request->passwordConf){

            $exists = User::where('username', $request->username)->first();

            if($exists){

                return redirect()->route('viewRegister.employee')->with('msgError', 'Esse nome de usuário já existe!');

            } else{

                $info = $request->only(['name', 'username', 'password']);
                $info['password'] = $request->password;
                $info['password'] = bcrypt($info['password']);
                
                if($request->level){
                    $info['level'] = $request->level;
                } else{
                    $info['level'] = 1;
                }

                $info['stats'] = 1;

                User::create($info);

                return redirect()->route('home.employee')->with('msg', 'Cadastro de funcionário(a) feito com sucesso!');
            }
        } else{
            return redirect()->route('viewRegister.employee')->with('msgError', 'As senhas não coincidem!');
        }
    }

    public function list(){

        $userLevel = User::userLevel();

        $employees = User::paginate(10);

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

        if($userLevel['level'] != 3 && $employee->level >= 2){
            return back()->withInput();
        }

        return view('user.employee.edit', [
            'userLevel' => $userLevel,
            'employee' => $employee
        ]);
    }

    public function update(Request $request){

        if($request->level){

            $user = User::find($request->id);

            $info = $request->only('id', 'name', 'username', 'level', 'stats');

            $user->update($info);

            return redirect()->route('home.employee')->with('msg', "Funcionário(a) editado(a) com sucesso!");

        } else{

            $user = User::find($request->id);

            $info = $request->only('id', 'name', 'username', 'stats');

            $user->update($info);

            return redirect()->route('home.employee')->with('msg', "Funcionário(a) editado(a) com sucesso!");
        }
    }

    public function destroy(Request $request){

        $id = $request->id;

        $employee = User::find($id);

        $delete = $employee->delete();

        if($delete){
            return redirect()->route('home.employee')->with('msg', "Funcionário(a) excluido com sucesso!");
            
        } else{
            return redirect()->route('home.employee')->with('msgError', "Erro ao excluir o(a) funcionário(a)!");
        }
    }
}