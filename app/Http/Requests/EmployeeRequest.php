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
            'username' => [
                'required',
                'string',
                'min:4',
                'max:16'
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
            'name.required' => 'Preencha o campo com seu nome completo!',
            'name.min' => 'O seu nome completo deve conter no minimo 3 caracteres!',
            'name.max' => 'O seu nome completo deve conter no maximo 45 caracteres!',

            'username.required' => 'Preencha o campo de nome de usuário!',
            'username.min' => 'O seu nome de usuário deve conter no minimo 4 caracteres!',
            'username.max' => 'O seu nome de usuário deve conter no maximo 16 caracteres!',

            'password.required' => 'Preencha o campo com uma senha!',
            'password.confirmation' => 'As senhas não são iguais!',
            'password.min' => 'Sua senha deve conter no minimo 3 caracteres!',
            'password.max' => 'Sua senha deve conter no maximo 16 caracteres!',
        ];
    }
}
