<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('status')) {
            Schema::create('status', function (Blueprint $table) {
                $table->id();
                $table->string('DescStatus', 100);
                $table->enum('Categoria', ['Pedido', 'Pagamento']);
                $table->timestamps();
            });

            $this->seedStatusTable();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('status');
    }

    private function seedStatusTable(): void
    {
        DB::table('status')->insert([
            ['DescStatus' => 'AGUARDANDO', 'Categoria' => 'Pagamento', 'id' => 10],
            ['DescStatus' => 'APROVADO', 'Categoria' => 'Pagamento', 'id' => 11],
            ['DescStatus' => 'REJEITADO', 'Categoria' => 'Pagamento', 'id' => 12],
            ['DescStatus' => 'CANCELADO', 'Categoria' => 'Pagamento', 'id' => 13],
            ['DescStatus' => 'ERRO', 'Categoria' => 'Pagamento', 'id' => 14],
            ['DescStatus' => 'AGUARDANDO', 'Categoria' => 'Pedido', 'id' => 1],
            ['DescStatus' => 'PRONTO', 'Categoria' => 'Pedido', 'id' => 2],
            ['DescStatus' => 'EM PREPARACAO', 'Categoria' => 'Pedido', 'id' => 3],
            ['DescStatus' => 'RECEBIDO', 'Categoria' => 'Pedido', 'id' => 4],
            ['DescStatus' => 'FINALIZADO', 'Categoria' => 'Pedido', 'id' => 5],
            ['DescStatus' => 'CANCELADO', 'Categoria' => 'Pedido', 'id' => 6]
        ]);
    }
}
