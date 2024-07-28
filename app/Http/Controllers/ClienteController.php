<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteCadastrarRequest;
use App\Http\Requests\ClienteIdentificarRequest;
use Cliente;

class ClienteController
{
    public function cadastrar(ClienteCadastrarRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $cliente = Cliente::cadastrarCliente($data);

        return response()->json($cliente, 201);
    }

    public function identificar(ClienteIdentificarRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $cliente = Cliente::identificarClientePorCPF($data['CPF']);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }
}
