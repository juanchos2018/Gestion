<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronogramaElementoConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronograma_elemento_configuracion', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Nombre');
            $table->string('Codigo');
            $table->integer('CronogramaFaseId')->unsigned();

            $table->foreign('CronogramaFaseId')->references('Id')->on('cronograma_fase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cronograma_elemento_configuracion');
    }
}
