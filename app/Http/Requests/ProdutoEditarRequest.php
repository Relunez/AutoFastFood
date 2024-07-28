<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoEditarRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nome' => 'sometimes|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'sometimes|numeric',
            'TipoProdutoId' => 'required|integer|exists:tipo_produto,id',
        ];
    }

    public function messages(): array
    {
        return [
            'Nome.sometimes' => 'O nome é opcional.',
            'Nome.string' => 'O nome deve ser uma string.',
            'Nome.max' => 'O nome não pode ter mais que 100 caracteres.',
            'Descricao.string' => 'A descrição deve ser uma string.',
            'Valor.sometimes' => 'O valor é opcional.',
            'Valor.numeric' => 'O valor deve ser um número.',
            'TipoProdutoId.required' => 'O tipo de produto é obrigatório.',
            'TipoProdutoId.string' => 'O tipo de produto deve ser uma string.',
            'TipoProdutoId.exists' => 'O ID do tipo de produto não existe.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
