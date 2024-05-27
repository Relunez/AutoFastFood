<?php

namespace App\Http\Controllers;

use App\Http\Services\ProdutoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function fakeCheckout(Request $request)
    {
        $data = $request->validate([
            'ClienteId' => 'required|integer|exists:cliente,id',
            'Produtos' => 'required|array',
            'Produtos.*.ProdutoId' => 'required|integer',
            'Produtos.*.Quantidade' => 'required|integer|min:1',
        ]);

        $pedido = $this->pedidoService->fakeCheckout($data);

        return response()->json($pedido, 201);
    }

    public function listarPedidos()
    {
        $pedidos = $this->pedidoService->listarPedidos();

        return response()->json($pedidos);
    }
}
