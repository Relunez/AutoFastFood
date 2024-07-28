<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\StatusPedido;

interface StatusPedidoRepositoryInterface
{
    public function create(array $data): StatusPedido;
    public function all(): \Illuminate\Database\Eloquent\Collection;
    public function atualizarStatus(int $id, array $data): bool;
}