<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApuEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_equipo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('equipo_id')->unsigned();
            $table->bigInteger('apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('rendimiento', 3, 0);
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('apu_id')->references('id')->on('apus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apu_equipo');
    }
}
