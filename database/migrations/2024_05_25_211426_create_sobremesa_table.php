<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSobremesaTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('sobremesa')) {
            Schema::create('sobremesa', function (Blueprint $table) {
                $table->id();
                $table->string('NomeSobremesa', 100);
                $table->text('DescSobremesa')->nullable();
                $table->decimal('ValorSobremesa', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sobremesa');
    }
}
