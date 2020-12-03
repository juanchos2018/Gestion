<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCambioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
        Schema::create('orden_cambio', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('SolicitudCambioId')->unsigned();
            $table->integer('JefeId')->unsigned();

            $table->date('FechaAprobación');
            $table->date('FechaInicio');
            $table->date('FechaTermino');
            $table->string('Descripcion', 1000);
            $table->integer('PorcertanjeAvance');
            $table->string('Estado',20);

            $table->foreign('SolicitudCambioId')->references('Id')->on('solicitud_cambio');
            $table->foreign('JefeId')->references('Id')->on('miembro_proyecto');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_cambio');
    }
}
