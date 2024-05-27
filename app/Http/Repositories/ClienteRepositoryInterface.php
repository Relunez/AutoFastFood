<?php

namespace App\Http\Repositories;

use App\Models\Cliente;

interface ClienteRepositoryInterface
{
    public function create(array $data): Cliente;
    public function findByCPF(string $cpf): ?Cliente;
}