<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronogramaFaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronograma_fase', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('CronogramaId')->unsigned();
            $table->string('Nombre');

            $table->foreign('CronogramaId')->references('Id')->on('cronograma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cronograma_fase');
    }
}
