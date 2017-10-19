<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApuTransporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_transporte', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transporte_id')->unsigned();
            $table->bigInteger('apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->timestamps();

            $table->foreign('transporte_id')->references('id')->on('transportes');
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
        Schema::dropIfExists('apu_transporte');
    }
}
