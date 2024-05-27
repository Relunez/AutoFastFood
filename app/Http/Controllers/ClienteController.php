<?php

namespace App\Http\Controllers;

use Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
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

        $cliente = Cliente::cadastrarCliente($data);

        return response()->json($cliente, 201);
    }

    public function identificar(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'CPF' => 'required|string|max:11',
        ]);

        $cliente = Cliente::identificarClientePorCPF($data['CPF']);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }
}
