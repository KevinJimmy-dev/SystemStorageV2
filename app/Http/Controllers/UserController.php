<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Traits\CheckAuth;
use Illuminate\Http\Request;
use App\Models\{
    Coordinator,
    Employee,
    User,
};

class UserController extends Controller
{
    use CheckAuth;

    public function create()
    {
        return view('user.employee.register');
    }

    public function store(Request $request)
    {
        if (!is_null(User::where('email', $request->email)->first())) {
            return redirect()->route('employee.create')->with('msgError', 'Esse email já está sendo utilizado!')->withInput();
        }

        if (!is_null(User::where('cpf', $request->cpf)->first())) {
            return redirect()->route('employee.create')->with('msgError', 'Esse cpf já está sendo utilizado!')->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cpf' => $request->cpf,
            'phone' => $request->phone,
        ]);

        if (!$request->function) {
            $request->function = 'employee';
        }

        switch ($request->function) {
            case 'employee':
                $employee = Employee::create([
                    'user_id' => $user->id
                ]);

                $user->update(['employee_id' => $employee->id]);
                break;

            case 'coordinator':
                $coordinator = Coordinator::create(['user_id' => $user->id]);

                $user->update(['coordinator' => $coordinator->id]);
                break;
        }

        return redirect()->route('employee.show')->with('msg', 'Cadastro de funcionário(a) realizado com sucesso!');
    }

    public function show()
    {
        if (!is_null($this->getUser()->employee_id)) {
            return redirect()->back();
        }

        $users = User::query();

        if (!is_null($this->user->coordinator_id)) {
            $users = $users->whereNotNull('employee_id');
        }

        if (!is_null($this->user->admin_id)) {
            $users = $users->whereNull('admin_id');
        }

        return view('user.employee.home', [
            'employees' => $users->orderBy('employee_id', 'asc')->orderBy('coordinator_id', 'asc')->paginate(10)
        ]);
    }

    public function edit($id)
    {
        $employee = User::find($id);

        if (is_null($employee)) {
            return redirect()->back();
        }

        if (!is_null($this->getUser()->employee_id) || !is_null($this->getUser()->coordinator_id) && !is_null($employee->coordinator_id)) {
            return redirect()->back();
        }

        return view('user.employee.edit', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        if (is_null($user)) {
            return redirect()->back();
        }

        $exists = User::where('cpf', $request->cpf)->first();

        if (!is_null($exists) && $user->id != $exists->id) {
            return redirect()->back()->withInput()->with('msgError', 'Este cpf já está em uso!');
        }

        $user->update($request->all());

        return redirect()->route('employee.show')->with('msg', "Funcionário(a) editado(a) com sucesso!");
    }

    public function destroy(Request $request)
    {
        $employee = User::find($request->id);

        $user = auth()->user();

        if (is_null($employee)) {
            return redirect()->back();
        }
        
        if (!is_null($employee->coordinator_id) && is_null($user->coordinator_id) && is_null($user->employee_id)) {
            $employee->coordinator->delete();
        } 
        
        if (!is_null($employee->admin_id) && is_null($user->coordinator_id) && is_null($user->employee_id)){
            $employee->admin->delete();
        }

        $employee->delete();

        return redirect()->route('employee.show')->with('msg', "Funcionário(a) excluido com sucesso!");
    }
}
