<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCambioDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('orden_cambio_detalle', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('OrdenCambioId')->unsigned();
            $table->integer('CronogramaElementoConfiguracionId')->unsigned();
            $table->integer('MiembroResponsableId')->unsigned();
            $table->date('FechaInicio');
            $table->date('FechaTermino');
            $table->integer('PorcertanjeAvance');
            $table->string('Predecesora', 200);
            $table->string('Descripcion', 700);

            $table->foreign('OrdenCambioId')->references('Id')->on('orden_cambio');
            $table->foreign('CronogramaElementoConfiguracionId')->references('Id')->on('cronograma_elemento_configuracion');
            $table->foreign('MiembroResponsableId')->references('Id')->on('miembro_proyecto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_cambio_detalle');
    }
}
