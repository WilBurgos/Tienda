<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlmacenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProducto')->unsigned()->nullable();
            $table->integer('Cantidad')->nullable();
            $table->integer('PrecioCompra')->nullable();
            $table->datetime('FechaCompra')->nullable();
            $table->integer('PrecioVenta')->nullable();
            $table->datetime('FechaSalida');
            $table->string('Observaciones', 255);

            $table->foreign('idProducto')->references('id')->on('producto');
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
        Schema::dropIfExists('almacen');
    }
}
