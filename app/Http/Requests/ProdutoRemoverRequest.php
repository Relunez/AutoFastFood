<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRemoverRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'TipoProduto' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'TipoProduto.required' => 'O tipo de produto é obrigatório.',
            'TipoProduto.string' => 'O tipo de produto deve ser uma string.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
