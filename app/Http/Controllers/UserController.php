<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
};

class UserController extends Controller{

    // Retorna a view de login para o usuario
    public function index(){
        return view('user.login');
    }

    // Verifica as credenciais e ou autentica ele, ou recebera uma mensagem de invalidação
    public function auth(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            if(auth()->check() && auth()->user()->stats == 1){
                return redirect()->route('user.index'); 
            } else{
                return redirect()->route('login')->with('msgWarning', "Usuário inativo!"); 
            }

        } else{
            return redirect()->route('login')->with('msgError', "Credenciais incorretas!"); 
        }
    }
    
    // Faz o logout do usuario e direciona ele pra pagina inicial
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    // Retorna a view de registro de funcionario
    public function viewRegister(){
        $userLevel = User::userLevel();

        return view('user.employee.register', [
            'userLevel' => $userLevel
        ]);

    }

    // Cria um novo funcionario(a) se tudo estiver correto
    public function create(EmployeeRequest $request){
        if($request->password == $request->passwordConf){
            $exists = User::where('username', $request->username)->first();

            $newEmployee = User::createEmployee($request, $exists);

            if($newEmployee){
                return redirect()->route('employee.list')->with('msg', 'Cadastro de funcionário(a) feito com sucesso!');
            } else{
                return redirect()->route('employee.viewRegister')->with('msgError', 'Esse nome de usuário já existe!');
            }
        } else{
            return redirect()->route('employee.viewRegister')->with('msgError', 'Esse nome de usuário já existe!');
        }
    }

    // Retorna todos os funcionarios cadastrados
    public function list(){
        $userLevel = User::userLevel();

        if($userLevel['level'] == 1){
            return back()->withInput();
        }

        $employees = User::orderBy('level')->paginate(10);

        return view('user.employee.home', [
            'userLevel' => $userLevel,
            'employees' => $employees
        ]);
    }

    // Retorna a view para editar um funcionario
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

    // Faz o update no banco com as novos valores
    public function update(EmployeeRequest $request){
        $user = User::find($request->id);

        if($request->level){
            $info = $request->only('id', 'name', 'username', 'level', 'stats');
        } else{
            $info = $request->only('id', 'name', 'username', 'stats');
        }

        $user->update($info);

        return redirect()->route('employee.list')->with('msg', "Funcionário(a) editado(a) com sucesso!");
    }

    // Exclui do banco o usuario selecionado
    public function destroy(Request $request){
        $id = $request->id;

        $employee = User::find($id);

        $delete = $employee->delete();

        if($delete){
            return redirect()->route('employee.list')->with('msg', "Funcionário(a) excluido com sucesso!");
        } else{
            return redirect()->route('employee.list')->with('msgError', "Erro ao excluir o(a) funcionário(a)!");
        }
    }
}