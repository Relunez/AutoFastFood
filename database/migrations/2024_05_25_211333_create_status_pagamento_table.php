<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPagamentoTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('status_pagamento')) {
            Schema::create('status_pagamento', function (Blueprint $table) {
                $table->id();
                $table->foreignId('PedidoId')->constrained('pedido');
                $table->foreignId('PagamentoId')->constrained('pagamento');
                $table->foreignId('StatusId')->constrained('status');
                $table->date('DataStatusPagamento');
                $table->time('HoraStatusPagamento');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('status_pagamento');
    }
}
