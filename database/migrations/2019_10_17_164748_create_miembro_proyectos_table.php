<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiembroProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembro_proyecto', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('UsuarioMiembroId')->unsigned();
            $table->integer('RolId')->unsigned();
            $table->integer('ProyectoId')->unsigned();


            $table->foreign('ProyectoId')->references('Id')->on('proyecto');
            $table->foreign('RolId')->references('Id')->on('rol');
            $table->foreign('UsuarioMiembroId')->references('Id')->on('usuario');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miembro_proyecto');
    }
}
