<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\StatusPagamento;

interface PagamentoRepositoryInterface
{
    public function create(array $data): StatusPagamento;
    public function all(): \Illuminate\Database\Eloquent\Collection;
}