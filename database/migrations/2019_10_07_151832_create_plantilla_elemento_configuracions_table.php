<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantillaElementoConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_elemento_configuracion', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('FaseId')->unsigned();
            $table->integer('ElementoConfiguracionId')->unsigned();
            $table->foreign('FaseId')->references('Id')->on('fase');
            $table->foreign('ElementoConfiguracionId')->references('Id')->on('elemento_configuracion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantilla_elemento_configuracion');
    }
}
