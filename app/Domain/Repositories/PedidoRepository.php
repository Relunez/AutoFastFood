<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\Pedido;


class PedidoRepository implements PedidoRepositoryInterface
{
    protected Pedido $model;

    public function __construct(Pedido $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Pedido
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->create($data);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence
            ->with([
                'cliente',
                'statusPagamentos',
                'pedidoProdutos',
                'statusPedidos',
            ])
            ->whereNotIn('statusPedidos.StatusId',[1,5,6])
            ->orderBy('statusPedidos.StatusId')
            ->orderBy('pedido.id')
            ->get();
    }

    public function get(int $id): Pedido
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence
            ->with([
                'cliente',
                'statusPagamentos',
                'pedidoProdutos',
                'statusPedidos',
            ])
            ->findOrFail($id);
    }
}
