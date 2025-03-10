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
        Schema::create('billetes', function (Blueprint $table) {
            $table->integer('sucursal'); // ID de la sucursal
            $table->integer('denominacion'); // Valor del billete (ej. 50, 100, 200)
            $table->integer('entregados')->default(0); // Cantidad de billetes entregados
            $table->integer('existencia')->default(0); // Cantidad de billetes disponibles

            $table->primary(['sucursal', 'denominacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billetes');
    }
};
