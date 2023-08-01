<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoCorrectivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_correctivo', function (Blueprint $table) {
            $table->id();
            $table->string('cantidad');
            $table->string('fecha');
            $table->timestamps();


            $table->foreignId('bitacora_id')->constrained();
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
        Schema::dropIfExists('equipo_correctivo');
    }
}
