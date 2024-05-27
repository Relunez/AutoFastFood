<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompanhamentoTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('acompanhamento')) {
            Schema::create('acompanhamento', function (Blueprint $table) {
                $table->id();
                $table->string('NomeAcompanhamento', 100);
                $table->text('DescAcompanhamento')->nullable();
                $table->decimal('ValorAcompanhamento', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('acompanhamento');
    }
}
