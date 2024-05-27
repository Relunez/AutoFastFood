<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pagamento')) {
            Schema::create('pagamento', function (Blueprint $table) {
                $table->id();
                $table->string('DescPagamento', 100);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamento');
    }
}
