<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('caja');

        Schema::create('caja', function (Blueprint $table) {
            $table->integer('sucursal')->default(1); // Sucursal única
            $table->integer('denominacion'); // 1000, 500, 200, etc.
            $table->integer('entregados')->default(1); // Siempre inicia en 1
            $table->integer('existencia'); // Generado aleatoriamente
            $table->timestamps();

            // Definir la clave primaria compuesta
            $table->primary(['sucursal', 'denominacion']);
        });

        // Insertar registros con denominaciones iniciales
        $denominaciones = [1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];

        foreach ($denominaciones as $denominacion) {
            \DB::table('caja')->insert([
                'sucursal' => 1,
                'denominacion' => $denominacion,
                'entregados' => 1,
                'existencia' => rand(1, 100), // Genera valores aleatorios entre 1 y 100
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('caja');
    }
}