<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoBuscarPorCategoriaRequest;
use App\Http\Requests\ProdutoCriarRequest;
use App\Http\Requests\ProdutoEditarRequest;
use App\Http\Requests\ProdutoRemoverRequest;
use Produto;

class ProdutoController
{
    public function criar(ProdutoCriarRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $produto = Produto::criarProduto($data);

        return response()->json($produto, 201);
    }

    public function editar(ProdutoEditarRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $produto = Produto::editarProduto($id, $data);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    public function remover(ProdutoRemoverRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $removido = Produto::removerProduto($id);

        if (!$removido) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json(['message' => 'Produto removido com sucesso']);
    }

    public function listar(): \Illuminate\Http\JsonResponse
    {
        $produtos = Produto::listar();

        if (!$produtos) {
            return response()->json(['message' => 'Produtos não encontrados'], 404);
        }

        return response()->json($produtos);
    }

    public function buscarPorCategoria(int $id): \Illuminate\Http\JsonResponse
    {
        $produtos = Produto::buscarPorCategoria($id);

        if (!$produtos) {
            return response()->json(['message' => 'Produtos não encontrados'], 404);
        }

        return response()->json($produtos);
    }
}
