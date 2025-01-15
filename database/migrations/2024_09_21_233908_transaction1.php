<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('transaction1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Relación con customers
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con users
            $table->decimal('amount', 10, 2); // Monto de la transacción
            $table->string('description')->nullable(); // Descripción de la transacción
            $table->string('pc_name'); // Nombre de la PC desde la que se realiza la transacción
            $table->decimal('comision', 10, 2)->nullable(); // Comisión
            $table->decimal('ganancia', 10, 2)->nullable(); // Ganancia
            $table->string('numero_cheque'); // Número de cheque
            $table->String('datetime_field'); // Fecha y hora de la transacción
            $table->integer('cantidad_cheques')->default(0); // Cantidad de cheques ingresados
            $table->decimal('total_comision', 10, 2)->default(0); // Total de comisiones
            $table->decimal('total_ganancias', 10, 2)->default(0); // Total de ganancias
            $table->decimal('total_monto', 10, 2)->default(0); // Total de monto

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
