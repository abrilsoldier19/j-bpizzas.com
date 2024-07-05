<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pedidos', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre_usuario');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('metodo_pago');
            $table->bigInteger('id_usuario');
            $table->string('productos');
            $table->integer('cantidad_productos')->default(false);
            $table->string('imagen_producto')->nullable();
            $table->string('total_pago');
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
        Schema::dropIfExists('orden_pedidos');
    }
}
