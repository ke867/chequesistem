<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_cliente')->unique();
            $table->string('nombre_cliente');
            $table->string('nombre_artistico');
            $table->string('foto');
            $table->boolean("Cambiar")->default(true);
            $table->string('direccion');
            $table->string('numero_telefono');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
