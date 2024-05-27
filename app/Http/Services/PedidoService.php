<?php

namespace App\Http\Services;

use App\Http\Repositories\PedidoRepository;
use App\Models\Pedido;

class PedidoService
{
    protected $pedidoRepository;

    public function __construct(PedidoRepository $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function fakeCheckout(array $data): Pedido
    {
        return $this->pedidoRepository->create($data);
    }

    public function listarPedidos()
    {
        return $this->pedidoRepository->all();
    }
}
