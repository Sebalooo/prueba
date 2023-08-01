<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->enum('estado',[1,2,3,4,5,6])->default(1);//activa/cancelada/inactiva
            $table->enum('tipo_orden',[1,2,3,4,5])->default(1);//solicitud-orden
            $table->enum('prioridad',[1,2,3,4,5])->default(1);//alta-baja
            $table->enum('tipo_mantencion',[1,2,3,4,5])->nullable()->default(1);//tipo
            $table->string('fecha_inicio');
            $table->string('fecha_termino')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajos');
    }
}
