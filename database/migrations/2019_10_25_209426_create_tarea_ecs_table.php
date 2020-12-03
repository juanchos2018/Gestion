<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaECSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    
    public function up()
    {
        Schema::create('tarea_ecs', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Codigo', 200);
            $table->integer('VersionECSId')->unsigned();
            $table->integer('MiembroResponsableId')->unsigned();
            $table->date('FechaInicio');
            $table->date('FechaTermino');
            $table->string('Descripcion',1000);
            $table->string('Justificacion',1000);
            $table->integer('PorcentajeAvance');
            $table->string('UrlEvidencia',200);
            $table->integer('TareaPadreId')->nullable()->unsigned();


            $table->foreign('TareaPadreId')->references('Id')->on('tarea_ecs');
            $table->foreign('VersionECSId')->references('Id')->on('version_ecs');
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
        Schema::dropIfExists('tarea_ecs');
    }
}
