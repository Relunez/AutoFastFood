<?php

namespace App\Http\Repositories;

use App\Models\Cliente;

class ClienteRepository
{
    protected Cliente $model;

    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Cliente
    {
        return $this->model->create($data);
    }

    public function findByCPF(string $cpf): ?Cliente
    {
        return $this->model->where('CPF', $cpf)->first();
    }
}
