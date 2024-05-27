<?php

namespace App\Http\Repositories;

interface ProdutoRepositoryInterface
{
    public function create(string $type, array $data);
    public function update(string $type, int $id, array $data);
    public function delete(string $type, int $id);
    public function findByCategory(string $type, string $id);
}