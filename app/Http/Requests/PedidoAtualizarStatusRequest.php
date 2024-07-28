<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PedidoAtualizarStatusRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'StatusId' => 'required|integer|exists:status,id',
        ];
    }

    public function messages(): array
    {
        return [
            'StatusId.required' => 'O ID do status é obrigatório.',
            'StatusId.integer' => 'O ID do status deve ser um número inteiro.',
            'StatusId.exists' => 'O ID do status não existe.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
        ], 400));
    }
}
