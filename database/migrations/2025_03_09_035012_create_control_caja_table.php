<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlCajaTable extends Migration
{
    public function up()
    {
        Schema::create('control_caja', function (Blueprint $table) {
            $table->id();
            $table->boolean('estatus')->default(false); // false significa que no está abierta
            $table->timestamps();
        });

        // Insertar el registro inicial
        \DB::table('control_caja')->insert([
            'estatus' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('control_caja');
    }
}