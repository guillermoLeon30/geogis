<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialBiblioApusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_biblioteca_apus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('material_id')->unsigned();
            $table->bigInteger('biblioteca_apu_id')->unsigned();
            $table->decimal('cantidad', 10, 2);
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materiales');
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
        Schema::dropIfExists('material_biblioteca_apus');
    }
}
