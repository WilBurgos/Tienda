<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idOrden')->unsigned();
            $table->foreign('idOrden')->references('id')->on('ordenes');
            // $table->integer('idCliente')->unsigned();
            // $table->foreign('idCliente')->references('id')->on('clientes');
            // $table->integer('idMesero')->unsigned();
            // $table->foreign('idMesero')->references('id')->on('users');
            $table->date('diaVenta');
            $table->integer('totalVenta');
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
        Schema::dropIfExists('ventas');
    }
}
