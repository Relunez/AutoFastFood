<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Persistence\Cliente;

interface ClienteRepositoryInterface
{
    public function create(array $data): Cliente;
    public function findByCPF(string $cpf): ?Cliente;
}