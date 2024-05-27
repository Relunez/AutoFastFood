<?php

namespace App\Http\Controllers;

use Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function criar(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'Nome' => 'required|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'required|numeric',
            'Categoria' => 'required|string',
            'TipoProduto' => 'required|string',
        ]);

        $produto = Produto::criarProduto($data['TipoProduto'] ,$data);

        return response()->json($produto, 201);
    }

    public function editar(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'Nome' => 'sometimes|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'sometimes|numeric',
            'TipoProduto' => 'required|string',
        ]);

        $produto = Produto::editarProduto($data['TipoProduto'], $id, $data);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    public function remover(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'TipoProduto' => 'required|string',
        ]);

        $removido = Produto::removerProduto($data['TipoProduto'], $id);

        if (!$removido) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json(['message' => 'Produto removido com sucesso']);
    }

    public function buscarPorCategoria(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'TipoProduto' => 'required|string',
        ]);

        $produtos = Produto::buscarPorCategoria($data['TipoProduto'], $id);

        if (!$produtos) {
            return response()->json(['message' => 'Produtos não encontrados'], 404);
        }

        return response()->json($produtos);
    }
}
