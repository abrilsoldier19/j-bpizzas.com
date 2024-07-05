<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_bebida');
            $table->unsignedBigInteger('id_postre');
            $table->bigInteger('id_comprador');
            $table->integer('cantidad_comprada_pizza')->default(false);
            $table->integer('cantidad_comprada_bebida')->default(false);
            $table->integer('cantidad_comprada_postre')->default(false);

            $table->foreign('id_producto')->references('id')->on('pizzeria')->onDelete('cascade');
            $table->foreign('id_bebida')->references('id')->on('bebidas')->onDelete('cascade');
            $table->foreign('id_postre')->references('id')->on('postres')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos');
    }
}
