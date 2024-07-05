<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre_producto');
            $table->double('precio_producto');
            $table->string('imagen_producto')->nullable();
            $table->bigInteger('id_usuario');
            $table->integer('cantidad_producto')->default(false);
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
