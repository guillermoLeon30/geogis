<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibliotecaApusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biblioteca_apuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion');
            $table->string('unidad');
            $table->integer('por_indirectos');
            $table->integer('por_utilidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biblioteca_apuses');
    }
}
