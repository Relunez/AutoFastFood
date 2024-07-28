<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoBuscarPorCategoriaRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tipo_produto,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O tipo de produto é obrigatório.',
            'id.string' => 'O tipo de produto deve ser uma string.',
            'id.exists' => 'O ID do tipo de produto não existe.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
