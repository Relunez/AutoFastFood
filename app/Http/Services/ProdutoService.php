<?php

namespace App\Http\Services;

use App\Http\Repositories\ProdutoRepository;
use App\Models\Produto;

class ProdutoService
{
    protected $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function criarProduto(array $data): Produto
    {
        return $this->produtoRepository->create($data);
    }

    public function editarProduto(int $id, array $data): ?Produto
    {
        return $this->produtoRepository->update($id, $data);
    }

    public function removerProduto(int $id): bool
    {
        return $this->produtoRepository->delete($id);
    }

    public function buscarPorCategoria(string $categoria)
    {
        return $this->produtoRepository->findByCategory($categoria);
    }
}
