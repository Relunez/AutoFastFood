<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProdutosTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pedido_produtos')) {
            Schema::create('pedido_produtos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('PedidoId')->constrained('pedido');
                $table->foreignId('ProdutoId')->constrained('produtos');
                $table->date('DataPedidoProdutos');
                $table->time('HoraPedidoProdutos');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_produtos');
    }
}
