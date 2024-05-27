<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancheTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('lanche')) {
            Schema::create('lanche', function (Blueprint $table) {
                $table->id();
                $table->string('NomeLanche', 100);
                $table->text('DescLanche')->nullable();
                $table->decimal('ValorLanche', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lanche');
    }
}
