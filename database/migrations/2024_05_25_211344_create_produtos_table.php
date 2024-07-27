<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('produtos')) {
            Schema::create('produtos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('TipoProdutoId')->constrained('tipo_produto');
                $table->string('Nome', 100);
                $table->text('Desc')->nullable();
                $table->decimal('Valor', 10, 2);
                $table->timestamps();
            });

            $this->seedProdutosTable();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }

    private function seedProdutosTable()
    {
        // Get the ID for the 'Lanches' type
        $lanchesId = DB::table('tipo_produto')->where('DescProduto', 'Lanches')->value('id');
        $acompanhamentosId = DB::table('tipo_produto')->where('DescProduto', 'Acompanhamentos')->value('id');
        $bebidasId = DB::table('tipo_produto')->where('DescProduto', 'Bebidas')->value('id');
        $sobremesasId = DB::table('tipo_produto')->where('DescProduto', 'Sobremesas')->value('id');

        // Insert the product
        DB::table('produtos')->insert([
            [
                'TipoProdutoId' => $lanchesId,
                'Nome' => 'X-salada',
                'Desc' => 'Lanche com hamburger, salada e queijo',
                'Valor' => 10.99,
            ],
            [
                'TipoProdutoId' => $acompanhamentosId,
                'Nome' => 'Fritas',
                'Desc' => 'Batatinha frita, quentinha',
                'Valor' => 4.99,
            ],
            [
                'TipoProdutoId' => $bebidasId,
                'Nome' => 'Coca-Cola Lata',
                'Desc' => 'Coquinha geladinha',
                'Valor' => 6.99,
            ],
            [
                'TipoProdutoId' => $sobremesasId,
                'Nome' => 'Casquinha de baunilha',
                'Desc' => 'Casquinha crocante com 2 bolas de sorvete sabor baunilha',
                'Valor' => 8.99,
            ]
        ]);
    }
}
