<?php

namespace App\Http\Controllers;

use Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function fakeCheckout(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'ClienteId' => 'required|integer|exists:cliente,id',
            'Produtos' => 'required|array',
            'Produtos.*.ProdutoId' => 'required|integer',
            'Produtos.*.Quantidade' => 'required|integer|min:1',
        ]);

        $pedido = Pedido::fakeCheckout($data);

        return response()->json($pedido, 201);
    }

    public function listarPedidos(): \Illuminate\Http\JsonResponse
    {
        $pedidos = Pedido::listarPedidos();

        return response()->json($pedidos);
    }
}
