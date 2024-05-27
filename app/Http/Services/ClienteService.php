<?php

namespace App\Http\Services;

use App\Models\Cliente;
use App\Http\Repositories\ClienteRepository;

class ClienteService
{
    protected ClienteRepository $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
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
