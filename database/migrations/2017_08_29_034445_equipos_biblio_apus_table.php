<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquiposBiblioApusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_biblioteca_apus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('equipo_id')->unsigned();
            $table->bigInteger('biblioteca_apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('rendimiento', 3, 0);
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('biblioteca_apu_id')->references('id')->on('biblioteca_apuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_biblioteca_apus');
    }
}
