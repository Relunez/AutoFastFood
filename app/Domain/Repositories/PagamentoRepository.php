<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\StatusPagamento;


class PagamentoRepository implements PagamentoRepositoryInterface
{
    protected StatusPagamento $model;

    public function __construct(StatusPagamento $model)
    {
        $this->model = $model;
    }

    public function create(array $data): StatusPagamento
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->create($data);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->get();
    }
}
