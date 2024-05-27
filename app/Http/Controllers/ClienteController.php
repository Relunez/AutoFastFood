<?php

namespace App\Http\Controllers;

use App\Http\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function cadastrar(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'CPF' => 'nullable|string|max:11|unique:cliente',
            'Nome' => 'nullable|string|max:100',
            'Email' => 'nullable|string|email|max:100',
        ]);

        // Verificar se pelo menos um campo foi fornecido
        if (!$request->filled('CPF') && !$request->filled('Nome') && !$request->filled('Email')) {
            return response()->json(['error' => 'Pelo menos um dos campos CPF, Nome ou Email deve ser fornecido'], 400);
        }

        $cliente = $this->clienteService->cadastrarCliente($data);

        return response()->json($cliente, 201);
    }

    public function identificar(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'CPF' => 'required|string|max:11',
        ]);

        $cliente = $this->clienteService->identificarClientePorCPF($data['CPF']);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }
}
