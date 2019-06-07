<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->increments('id');
            //nombre
            $table->string('nombre',255);
            //tipoComida (comida, bebida, jugo, refresco)
            $table->enum('tipoComida',['COMIDA','BEBIDA'])->default('COMIDA');
            //precio
            $table->integer('precio');
            $table->string('codigo',255);
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
        Schema::dropIfExists('alimentos');
    }
}
