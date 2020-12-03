<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeCambioDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // +Id
        // +UsuarioResponsableId
        // +CronogramaElementoConfiguracionId
        // +Tiempo
        // +Costo
        Schema::create('detalle_informe', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('InformeCambioId')->unsigned();
            $table->integer('CronogramaElementoConfiguracionId')->unsigned();
            $table->decimal('Tiempo', 10, 2);
            $table->decimal('Costo', 10, 2);
            $table->string('Descripcion',700);
     
            $table->foreign('InformeCambioId')->references('Id')->on('informe_cambio');
            $table->foreign('CronogramaElementoConfiguracionId')->references('Id')->on('cronograma_elemento_configuracion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_informe');
    }
}
