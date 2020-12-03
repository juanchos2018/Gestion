<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('usuario', function (Blueprint $table) {

            $table->increments('Id');
            $table->string('Nombre', 100);
            $table->string('Apellido', 100);
            $table->string('Correo', 100)->unique();
            $table->string('password', 100);
            $table->integer('TipoUsuarioId')->unsigned();
            $table->foreign('TipoUsuarioId')->references('Id')->on('tipo_usuario');
            //$table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
