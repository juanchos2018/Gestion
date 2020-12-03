<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 
        Schema::create('informe_cambio', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Codigo', 20);
            $table->integer('SolicitudCambioId')->unsigned();
            $table->string('Descripcion', 400);
            $table->string('Tiempo', 2000);
            $table->decimal('CostoEconomico', 10, 2);
            $table->string('ImpactoProblema', 1000);
            $table->date('Fecha');
            $table->integer('MiembroJefeId')->unsigned();
            $table->String('Estado',20);
            
            $table->foreign('SolicitudCambioId')->references('Id')->on('solicitud_cambio');
            $table->foreign('MiembroJefeId')->references('Id')->on('miembro_proyecto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informe_cambio');
    }
}
