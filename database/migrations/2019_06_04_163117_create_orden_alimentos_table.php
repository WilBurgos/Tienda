<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenalimentos', function (Blueprint $table) {
            $table->increments('id');
            //idOrden (tabla ordenes)
            $table->integer('idOrden')->unsigned();
            $table->foreign('idOrden')->references('id')->on('ordenes');
            //idAlimentos (tabla alimentos)
            $table->integer('idAlimento')->unsigned();
            $table->foreign('idAlimento')->references('id')->on('alimentos');
            //cantidad
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenAlimentos');
    }
}
