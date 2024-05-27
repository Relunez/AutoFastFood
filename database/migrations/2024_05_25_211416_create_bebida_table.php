<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBebidaTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bebida')) {
            Schema::create('bebida', function (Blueprint $table) {
                $table->id();
                $table->string('NomeBebida', 100);
                $table->text('DescBebida')->nullable();
                $table->decimal('ValorBebida', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bebida');
    }
}
