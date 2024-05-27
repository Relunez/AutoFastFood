<?php

namespace App\Http\Controllers;

use App\Http\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    public function criar(Request $request)
    {
        $data = $request->validate([
            'Nome' => 'required|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'required|numeric',
            'Categoria' => 'required|string',
        ]);

        $produto = $this->produtoService->criarProduto($data);

        return response()->json($produto, 201);
    }

    public function editar(Request $request, int $id)
    {
        $data = $request->validate([
            'Nome' => 'sometimes|string|max:100',
            'Descricao' => 'nullable|string',
            'Valor' => 'sometimes|numeric',
            'Categoria' => 'sometimes|string',
        ]);

        $produto = $this->produtoService->editarProduto($id, $data);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    public function remover(int $id)
    {
        $removido = $this->produtoService->removerProduto($id);

        if (!$removido) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json(['message' => 'Produto removido com sucesso']);
    }

    public function buscarPorCategoria(Request $request)
    {
        $data = $request->validate([
            'Categoria' => 'required|string',
        ]);

        $produtos = $this->produtoService->buscarPorCategoria($data['Categoria']);

        return response()->json($produtos);
    }
}
