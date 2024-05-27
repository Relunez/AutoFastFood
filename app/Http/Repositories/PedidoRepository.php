<?php

namespace App\Http\Repositories;

use App\Models\Pedido;


class PedidoRepository
{
    protected $model;

    public function __construct(Pedido $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Pedido
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }
}
