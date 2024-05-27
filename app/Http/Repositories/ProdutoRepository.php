<?php

namespace App\Http\Repositories;

use App\Models\Produto;

class ProdutoRepository
{
    protected $model;

    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Produto
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Produto
    {
        $produto = $this->model->find($id);
        if ($produto) {
            $produto->update($data);
            return $produto;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $produto = $this->model->find($id);
        if ($produto) {
            return $produto->delete();
        }
        return false;
    }

    public function findByCategory(string $categoria)
    {
        return $this->model->where('Categoria', $categoria)->get();
    }
}
