<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

// Rotas de Clientes
Route::prefix('clientes')->group(function () {
    Route::post('/', [ClienteController::class, 'cadastrar']);
    Route::get('/identificar', [ClienteController::class, 'identificar']);
});

// Rotas de Produtos
Route::prefix('produtos')->group(function () {
    Route::post('/', [ProdutoController::class, 'criar']);
    Route::put('/{id}', [ProdutoController::class, 'editar']);
    Route::delete('/{id}', [ProdutoController::class, 'remover']);
    Route::get('/buscar', [ProdutoController::class, 'buscarPorCategoria']);
});

// Rotas de Pedidos
Route::prefix('pedidos')->group(function () {
    Route::post('/checkout', [PedidoController::class, 'fakeCheckout']);
    Route::get('/', [PedidoController::class, 'listarPedidos']);
});