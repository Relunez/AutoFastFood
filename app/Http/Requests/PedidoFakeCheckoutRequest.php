<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PedidoFakeCheckoutRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ClienteId' => 'required|integer|exists:cliente,id',
            'pagamentoId' => 'sometimes|integer|exists:pagamentos,id',
            'Produtos' => 'required|array',
            'Produtos.*.ProdutoId' => 'required|integer|exists:produtos,id',
            'Produtos.*.Quantidade' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'ClienteId.required' => 'O ID do cliente é obrigatório.',
            'ClienteId.integer' => 'O ID do cliente deve ser um número inteiro.',
            'ClienteId.exists' => 'O ID do cliente não existe.',
            'pagamentoId.sometimes' => 'O pagamento é opcional.',
            'pagamentoId.integer' => 'O ID de pagamento deve ser um número inteiro.',
            'pagamentoId.exists' => 'O ID de pagamento não existe.',
            'Produtos.required' => 'A lista de produtos é obrigatória.',
            'Produtos.array' => 'A lista de produtos deve ser um array.',
            'Produtos.*.ProdutoId.required' => 'O ID do produto é obrigatório.',
            'Produtos.*.ProdutoId.integer' => 'O ID do produto deve ser um número inteiro.',
            'Produtos.*.ProdutoId.exists' => 'O ID do produto não existe.',
            'Produtos.*.Quantidade.required' => 'A quantidade do produto é obrigatória.',
            'Produtos.*.Quantidade.integer' => 'A quantidade do produto deve ser um número inteiro.',
            'Produtos.*.Quantidade.min' => 'A quantidade do produto deve ser pelo menos 1.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
