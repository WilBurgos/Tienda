<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            //idOrdenAlimento (tabla ordenAlimentos)
            //$table->integer('idOrdenAlimento')->unsigned();
            //$table->foreign('idOrdenAlimento')->references('id')->on('ordenAlimentos');
            //idMesero (tabla users)
            $table->integer('idMesero')->unsigned();
            $table->foreign('idMesero')->references('id')->on('users');
            //idCliente (tabla clientes)
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes');
            //folioOrden
            $table->string('folioOrden',255);
            //numMesa
            $table->integer('numMesa');
            $table->date('diaOrden');
            //estatusOrden (pendiente,consumiendo,cerrada,pagada)
            $table->enum('estatusOrden',['PENDIENTE','CONSUMIENDO','CERRADA','PAGADA'])->default('PENDIENTE');
            $table->integer('totalOrden');
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
        Schema::dropIfExists('ordenes');
    }
}
