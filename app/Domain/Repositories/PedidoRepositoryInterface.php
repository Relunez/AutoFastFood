<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\Pedido;

interface PedidoRepositoryInterface
{
    public function create(array $data): Pedido;
    public function all(): \Illuminate\Database\Eloquent\Collection;
    public function get(int $id): Pedido;
}