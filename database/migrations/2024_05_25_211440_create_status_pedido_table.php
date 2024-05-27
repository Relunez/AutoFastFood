<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPedidoTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('status_pedido')) {
            Schema::create('status_pedido', function (Blueprint $table) {
                $table->id();
                $table->foreignId('PedidoId')->constrained('pedido');
                $table->foreignId('StatusId')->constrained('status');
                $table->date('DataStatus');
                $table->time('HoraStatus');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('status_pedido');
    }
}
