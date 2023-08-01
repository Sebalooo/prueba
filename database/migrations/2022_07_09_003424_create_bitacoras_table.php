<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('observacion');
            $table->string('fecha');
            $table->tinyInteger('fundador')->nullable();

            $table->timestamps();
       
             $table->foreignId('trabajo_id')->constrained();
             $table->foreignId('user_id')->constrained();
            // $table>foreignId('inventario_id')->constrained();
       
        });



        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
}
