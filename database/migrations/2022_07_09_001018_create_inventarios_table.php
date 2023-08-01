<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
           
            $table->id('id');
            $table->integer('serie')->nullable();
            $table->string("lote")->nullable();
            $table->string("serial");
            $table->integer('estado');
            $table->enum('tipo',[1,2,3,4,5])->default(1);
            $table->string('fecha_ingreso');
            $table->string('fecha_baja')->nullable()->default(null);
            $table->timestamps();

            /*$table->unsignedBigInteger('unidad_id');

            $table->foreign('unidad_id')->references('id')->on('unidads');*/

            $table->foreignId('unidad_id')->constrained();
            $table->foreignId('detalle_id')->constrained();
            //$table->foreignId('bitacora_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
