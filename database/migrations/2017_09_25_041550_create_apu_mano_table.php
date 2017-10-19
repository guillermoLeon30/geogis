<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApuManoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_mano_de_obra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mano_de_obra_id')->unsigned();
            $table->bigInteger('apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('rendimiento', 3, 0);
            $table->timestamps();

            $table->foreign('mano_de_obra_id')->references('id')->on('mano_de_obras');
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
        Schema::dropIfExists('apu_mano_de_obra');
    }
}
