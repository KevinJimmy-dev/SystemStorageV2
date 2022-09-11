<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => [
                'required',
                'string',
                'min:4',
                'max:45'
            ],
            'email' => [
                'required',
                'email',
            ],
            'cpf' => [
                'required',
                'min:11',
                'max:11',
            ],
            'phone' => [
                'required',
                'min:9',
                'max:9',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:3',
                'max:16',
            ],
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Preencha o campo com o nome completo!',
            'name.min' => 'O nome completo deve conter no minimo 3 caracteres!',
            'name.max' => 'O nome completo deve conter no maximo 45 caracteres!',

            'email.required' => 'Preencha o campo de email do usuário!',

            'cpf.required' => 'Preencha o campo cpf!',
            'cpf.min' => 'Cpf inválido!',
            'cpf.max' => 'Cpf inválido',

            'phone.required' => 'Preencha o campo telefone!',
            'phone.min' => 'Telefone inválido!',
            'phone.max' => 'Telefone inválido',

            'password.required' => 'Preencha o campo com uma senha!',
            'password.confirmed' => 'As senhas não são coincidem!',
            'password.min' => 'Sua senha deve conter no minimo 3 caracteres!',
            'password.max' => 'Sua senha deve conter no maximo 16 caracteres!',
        ];
    }
}
