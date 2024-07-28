<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoAtualizarStatusRequest;
use App\Http\Requests\PedidoFakeCheckoutRequest;
use Pedido;

class PedidoController
{
    public function fakeCheckout(PedidoFakeCheckoutRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $pedido = Pedido::fakeCheckout($data);

        return response()->json(['message' => 'Pedido criado com sucesso', 'pedido_id' => $pedido['pedido']->id, 'pagamento' => $pedido['pagamento']], 201);
    }

    public function listarPedidos(): \Illuminate\Http\JsonResponse
    {
        $pedidos = Pedido::listarPedidos();

        return response()->json($pedidos);
    }

    public function atualizarStatus(PedidoAtualizarStatusRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $pedidos = Pedido::atualizarStatus($data, $id);

        return response()->json($pedidos);
    }
}
