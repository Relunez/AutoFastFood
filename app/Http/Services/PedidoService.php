<?php

namespace App\Http\Services;

use App\Http\Repositories\PedidoRepositoryInterface;
use App\Models\Pedido;

class PedidoService
{
    protected PedidoRepositoryInterface $pedidoRepository;

    public function __construct(PedidoRepositoryInterface $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function fakeCheckout(array $data): Pedido
    {
        return $this->pedidoRepository->create($data);
    }

    public function listarPedidos(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->pedidoRepository->all();
    }
}
