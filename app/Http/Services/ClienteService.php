<?php

namespace App\Http\Services;

use App\Models\Cliente;
use App\Http\Repositories\ClienteRepositoryInterface;

class ClienteService
{
    protected ClienteRepositoryInterface $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function cadastrarCliente(array $data): Cliente
    {
        return $this->clienteRepository->create($data);
    }

    public function identificarClientePorCPF(string $cpf): ?Cliente
    {
        return $this->clienteRepository->findByCPF($cpf);
    }
}
