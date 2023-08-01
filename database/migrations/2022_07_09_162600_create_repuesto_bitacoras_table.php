<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestoBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repuesto_bitacoras', function (Blueprint $table) {
            $table->id();
            $table->string("cantidad");
            $table->string("fecha");
            $table->timestamps();


            $table->foreignId("repuesto_id")->constrained();
            $table->foreignId("bitacora_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repuesto_bitacoras');
    }
}
