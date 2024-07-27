<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoCriarRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nome' => 'required|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'required|numeric',
            'Categoria' => 'required|string',
            'TipoProduto' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'Nome.required' => 'O nome é obrigatório.',
            'Nome.string' => 'O nome deve ser uma string.',
            'Nome.max' => 'O nome não pode ter mais que 100 caracteres.',
            'Descricao.string' => 'A descrição deve ser uma string.',
            'Valor.required' => 'O valor é obrigatório.',
            'Valor.numeric' => 'O valor deve ser um número.',
            'Categoria.required' => 'A categoria é obrigatória.',
            'Categoria.string' => 'A categoria deve ser uma string.',
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
