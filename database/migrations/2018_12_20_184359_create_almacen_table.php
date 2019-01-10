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
            $table->integer('idProducto')->unsigned();
            $table->integer('cantidad');
            $table->integer('precioCompra');
            $table->datetime('fechaCompra');
            $table->integer('precioVenta');
            $table->datetime('fechaSalida');
            $table->string('observaciones', 255);

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
