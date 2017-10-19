<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManoObraBiblioApusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mano_de_obra_biblioteca_apus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mano_de_obra_id')->unsigned();
            $table->bigInteger('biblioteca_apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('rendimiento', 3, 0);
            $table->timestamps();

            $table->foreign('mano_de_obra_id')->references('id')->on('mano_de_obras');
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
        Schema::dropIfExists('mano_de_obra_biblioteca_apus');
    }
}
