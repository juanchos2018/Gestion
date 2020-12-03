<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Codigo');
            $table->string('Nombre');
            $table->date('FechaInicio');
            $table->date('FechaTermino');
            $table->string('Descripcion');
            $table->string('Estado');
            $table->integer('UsuarioJefeId')->unsigned();
            $table->integer('MetodologiaId')->unsigned();
            
            $table->foreign('UsuarioJefeId')->references('Id')->on('usuario');
            $table->foreign('MetodologiaId')->references('Id')->on('metodologia');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto');
    }
}
