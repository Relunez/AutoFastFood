<?php

namespace App\Http\Repositories;

use App\Models\Pedido;

interface PedidoRepositoryInterface
{
    public function create(array $data): Pedido;
    public function all(): \Illuminate\Database\Eloquent\Collection;
}