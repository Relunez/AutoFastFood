<?php

namespace App\Http\Repositories;

use App\Models\Acompanhamento;
use App\Models\Lanche;
use App\Models\Bebida;
use App\Models\Sobremesa;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    protected array $models = [
        'Acompanhamento' => Acompanhamento::class,
        'Lanche' => Lanche::class,
        'Bebida' => Bebida::class,
        'Sobremesa' => Sobremesa::class,
    ];

    public function getModel(string $type)
    {
        return $this->models[$type] ?? null;
    }

    public function create(string $type, array $data)
    {
        $modelClass = $this->getModel($type);
        if (!$modelClass) {
            throw new \Exception("Invalid product type: {$type}");
        }
        return $modelClass::create($data);
    }

    public function update(string $type, int $id, array $data)
    {
        $modelClass = $this->getModel($type);
        if (!$modelClass) {
            throw new \Exception("Invalid product type: {$type}");
        }
        $produto = $modelClass::find($id);
        if ($produto) {
            $produto->update($data);
            return $produto;
        }
        return null;
    }

    public function delete(string $type, int $id)
    {
        $modelClass = $this->getModel($type);
        if (!$modelClass) {
            throw new \Exception("Invalid product type: {$type}");
        }
        $produto = $modelClass::find($id);
        if ($produto) {
            return $produto->delete();
        }
        return false;
    }

    public function findByCategory(string $type, string $id)
    {
        $modelClass = $this->getModel($type);
        if (!$modelClass) {
            throw new \Exception("Invalid product type: {$type}");
        }
        return $modelClass::find($id)->get();
    }
}
