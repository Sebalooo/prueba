<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('cantidad');
            $table->string('fecha');
            $table->timestamps();


            $table->foreignId('trabajo_id')->constrained();
            $table->foreignId('inventario_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_trabajos');
    }
}
