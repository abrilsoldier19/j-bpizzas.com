<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoPizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_pizzas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_producto');
            $table->bigInteger('id_comprador');
            $table->integer('cantidad_comprada')->default(false);

            $table->foreign('id_producto')->references('id')->on('pizzeria')->onDelete('cascade');
        $table->foreign('id_comprador')->references('id')->on('usuarios')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_pizzas');
    }
}
