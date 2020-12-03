<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Nombre', 200);
            $table->integer('MetodologiaId')->unsigned();
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
        Schema::dropIfExists('fase');
    }
}
