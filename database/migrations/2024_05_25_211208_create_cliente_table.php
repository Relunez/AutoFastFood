<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cliente')) {
            Schema::create('cliente', function (Blueprint $table) {
                $table->id();
                $table->string('CPF', 11)->unique();
                $table->string('Nome', 100);
                $table->string('Email', 100)->nullable();
                $table->date('DataCliente');
                $table->time('HoraCliente');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
}
