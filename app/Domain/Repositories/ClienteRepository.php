<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\Cliente;

class ClienteRepository implements ClienteRepositoryInterface
{
    protected Cliente $model;

    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Cliente
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->create($data);
    }

    public function findByCPF(string $cpf): ?Cliente
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->where('CPF', $cpf)->first();
    }
}
