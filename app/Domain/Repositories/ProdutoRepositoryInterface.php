<?php

namespace App\Domain\Repositories;

interface ProdutoRepositoryInterface
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): ?bool;
    public function findByCategory(string $id): array;

    public function listar(): array;
}