<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class EncerrarLoteRequest
 * @package   ICSColetaLv\Http\Requests
 * @author    Mauricio Martins <mauricio.martins@totalexpress.com.br>
 * @copyright Total Express <www.totalexpress.com.br>
 */
class ClienteCadastrarRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'CPF' => 'nullable|string|size:11|unique:cliente,CPF',
            'Nome' => 'nullable|string|max:100',
            'Email' => 'nullable|email|unique:cliente,Email',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->filled('CPF') && !$this->filled('Nome') && !$this->filled('Email')) {
                $validator->errors()->add('CPF', 'Pelo menos um dos campos CPF, Nome ou Email deve ser fornecido');
            }
        });
    }

    public function messages(): array
    {
        return [
            'CPF.size' => 'O CPF deve ter exatamente 11 caracteres.',
            'CPF.unique' => 'Este CPF já está cadastrado.',
            'Nome.max' => 'O nome não pode ter mais que 100 caracteres.',
            'Email.email' => 'O email deve ser um endereço de email válido.',
            'Email.unique' => 'Este email já está cadastrado.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->all(),
        ], 400));
    }
}
