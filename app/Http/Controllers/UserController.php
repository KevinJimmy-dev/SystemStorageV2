<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Traits\CheckAuth;
use Illuminate\Http\Request;
use App\Models\{
    User,
};

class UserController extends Controller
{
    // Return view for create employee
    public function create()
    {
        $userLevel = User::userLevel();

        return view('user.employee.register', [
            'userLevel' => $userLevel
        ]);
    }

    // Create the new employee
    public function store(EmployeeRequest $request)
    {
        $exists = User::where('username', $request->username)->first();

        if(!is_null($exists)){
            return redirect()->route('employee.create')->with('msgError', 'Esse nome de usuário já existe!');
        }

        $info = $request->only(['name', 'username', 'password']);
        $info['password'] = bcrypt($info['password']);

        $info['level'] = $request->level ?? 1;

        User::query()->create($info);

        return redirect()->route('employee.show')->with('msg', 'Cadastro de funcionário(a) realizado com sucesso!');
    }

    // Return employees
    public function show()
    {
        $userLevel = User::userLevel();

        if ($userLevel == 1) {
            return back()->withInput();
        }

        $employees = User::orderBy('level')->paginate(10);

        return view('user.employee.home', [
            'userLevel' => $userLevel,
            'employees' => $employees
        ]);
    }

    // Return view to edit
    public function edit($id)
    {
        $userLevel = User::userLevel();

        if (!$employee = User::find($id)) {
            return back()->withInput();
        }

        if ($userLevel != 3 && $employee->level >= 2) {
            return back()->withInput();
        }

        return view('user.employee.edit', [
            'userLevel' => $userLevel,
            'employee' => $employee
        ]);
    }

    // Update employee
    public function update(EmployeeRequest $request)
    {
        $user = User::find($request->id);

        $user->update($request->all());

        return redirect()->route('employee.show')->with('msg', "Funcionário(a) editado(a) com sucesso!");
    }

    // Exclui do banco o usuario selecionado
    public function destroy(Request $request)
    {
        $id = $request->id;

        $employee = User::find($id);

        $delete = $employee->delete();

        if ($delete) {
            return redirect()->route('employee.show')->with('msg', "Funcionário(a) excluido com sucesso!");
        } else {
            return redirect()->route('employee.show')->with('msgError', "Erro ao excluir o(a) funcionário(a)!");
        }
    }
}
