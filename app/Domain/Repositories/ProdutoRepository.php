<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\Produtos;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    protected Produtos $model;

    public function __construct(Produtos $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->create($data);
    }

    public function update(int $id, array $data)
    {
        $modelPersistence = $this->model->newQuery();

        $produto = $modelPersistence->find($id);
        if ($produto) {
            $produto->update($data);
            return $produto;
        }
        return null;
    }

    public function delete(int $id): ?bool
    {
        $modelPersistence = $this->model->newQuery();

        $produto = $modelPersistence->find($id);
        if ($produto) {
            return $produto->delete();
        }
        return false;
    }

    public function findByCategory(string $id): array
    {
        $modelPersistence = $this->model->newQuery();
        return $modelPersistence->find($id)->toArray();
    }
}
