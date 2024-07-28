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
            'id' => 'required|integer|exists:produto,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O id produto é obrigatório.',
            'id.string' => 'O id do produto deve ser um numero.',
            'id.exists' => 'O id do produto não existe.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
