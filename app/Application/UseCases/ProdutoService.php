<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ProdutoRepositoryInterface;

class ProdutoService
{
    protected ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function criarProduto(array $data)
    {
        return $this->produtoRepository->create($data);
    }

    public function editarProduto(int $id, array $data)
    {
        return $this->produtoRepository->update($id, $data);
    }

    public function removerProduto(int $id): bool
    {
        return $this->produtoRepository->delete($id);
    }

    public function listar(): array
    {
        return $this->produtoRepository->listar();
    }

    public function buscarPorCategoria(string $id): array
    {
        return $this->produtoRepository->findByCategory($id);
    }
}
