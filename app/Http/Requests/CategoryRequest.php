<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest{
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
            'name_categorie' => [
                'required',
                'string',
                'min:3',
                'max:20'
            ]
        ];
    }

    public function messages(){
        return [
            'name_categorie.required' => 'Preencha o campo com o nome da categoria!',
            'name_categorie.min' => 'O minimo de caracteres é 3!',
            'name_categorie.max' => 'O maximo de caracteres é 20!',
        ];
    }
}
