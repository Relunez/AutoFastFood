<?php

namespace App\Http\Services;

use App\Http\Repositories\ProdutoRepositoryInterface;

class ProdutoService
{
    protected ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function criarProduto(string $type, array $data)
    {
        return $this->produtoRepository->create($type, $data);
    }

    public function editarProduto(string $type, int $id, array $data)
    {
        return $this->produtoRepository->update($type, $id, $data);
    }

    public function removerProduto(string $type, int $id): bool
    {
        return $this->produtoRepository->delete($type, $id);
    }

    public function buscarPorCategoria(string $type, string $id)
    {
        return $this->produtoRepository->findByCategory($type, $id);
    }
}
