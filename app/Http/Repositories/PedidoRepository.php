<?php

namespace App\Http\Repositories;

use App\Models\Pedido;


class PedidoRepository implements PedidoRepositoryInterface
{
    protected Pedido $model;

    public function __construct(Pedido $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Pedido
    {
        return $this->model->create($data);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }
}
