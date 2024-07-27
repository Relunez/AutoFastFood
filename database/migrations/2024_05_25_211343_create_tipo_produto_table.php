<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTipoProdutoTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tipo_produto')) {
            Schema::create('tipo_produto', function (Blueprint $table) {
                $table->id();
                $table->text('DescProduto');
                $table->timestamps();
            });

            $this->seedTipoProdutoTable();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_produto');
    }

    private function seedTipoProdutoTable(): void
    {
        DB::table('tipo_produto')->insert([
            ['DescProduto' => 'Lanches'],
            ['DescProduto' => 'Sobremesas'],
            ['DescProduto' => 'Acompanhamentos'],
            ['DescProduto' => 'Bebidas'],
        ]);
    }
}
