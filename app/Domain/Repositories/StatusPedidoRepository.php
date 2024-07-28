<?php

namespace App\Domain\Repositories;


use App\Infrastructure\Persistence\StatusPedido;


class StatusPedidoRepository implements StatusPedidoRepositoryInterface
{
    protected StatusPedido $model;

    public function __construct(StatusPedido $model)
    {
        $this->model = $model;
    }

    public function create(array $data): StatusPedido
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->create($data);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->get();
    }

    public function atualizarStatus(int $id, array $data): bool
    {
        $modelPersistence = $this->model->newQuery();

        $statusPedido = $modelPersistence->find($id);
        if ($statusPedido) {
            $statusPedido->update($data);
            return $statusPedido;
        }
        return false;
    }
}
