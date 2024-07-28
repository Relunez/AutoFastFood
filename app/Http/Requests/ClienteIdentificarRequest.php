<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class EncerrarLoteRequest
 * @package   ICSColetaLv\Http\Requests
 * @author    Mauricio Martins <mauricio.martins@totalexpress.com.br>
 * @copyright Total Express <www.totalexpress.com.br>
 */
class ClienteIdentificarRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'CPF' => 'required|string|max:11',
        ];
    }

    public function messages(): array
    {
        return [
            'CPF.required' => 'O CPF é obrigatório.',
            'CPF.string' => 'O CPF deve ser uma string.',
            'CPF.max' => 'O CPF não pode ter mais que 11 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->all(),
        ], 400));
    }
}
