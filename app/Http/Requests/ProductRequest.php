<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'min:2',
                'max:20'
            ],
            'storageUnity' => [
                'required'
            ],
            'quantity' => [
                'required',
                'min:1',
                'max:9'
            ],
            'deliveryDate' => [
                'required',
                'date'
            ],
            'expirationDate' => [
                'required',
                'date'
            ],
            'observation' => [
                'nullable',
                'string',
                'max:250'
            ]
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Preencha o campo nome!',
            'name.min' => 'O minimo de caracteres do campo nome é 2!',
            'name.max' => 'O maximo de caracteres do campo nome é 20!',
            'storageUnity.required' => 'Selecione uma das opções!',
            'quantity.required' => 'Preencha o campo com uma quantidade!',
            'quantity.number' => 'O campo deve conter somente números!',
            'quantity.min' => 'O minimo de caracteres do campo quantidade é 1!',
            'quantity.max' => 'O maximo de caracteres do campo quantidade é 9!',
            'deliveryDate.required' => 'Insira a data em que foi entregue!',
            'deliveryDate.date' => 'Insira uma data!',
            'expirationDate.required' => 'Insira a data de validade!',
            'expirationDate.date' => 'Insira uma data!',
            'observation.max' => 'O maximo de caracteres do campo de observação é 250!'
        ];
    }
}
