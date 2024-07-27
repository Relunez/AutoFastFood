<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoFakeCheckoutRequest;
use Pedido;

class PedidoController
{
    public function fakeCheckout(PedidoFakeCheckoutRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        $pedido = Pedido::fakeCheckout($data);

        return response()->json(['message' => 'Pedido criado com sucesso', 'pedido_id' => $pedido->id], 201);
    }

    public function listarPedidos(): \Illuminate\Http\JsonResponse
    {
        $pedidos = Pedido::listarPedidos();

        return response()->json($pedidos);
    }

    public function atualizarStatus(PedidoAtualizarStatusRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $pedidos = Pedido::atualizarStatus();

        return response()->json($pedidos);
    }
}
