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
        $table->id('id'); // Manteniendo tu estilo original de id

        $table->integer('cantidad_comprada_pizza')->default(0);
        $table->integer('cantidad_comprada_bebida')->default(0);
        $table->integer('cantidad_comprada_postre')->default(0);

        // MAPEO DE LLAVES FORÁNEAS (Apuntando a tus nombres reales en singular)
        $table->foreignId('id_producto')->constrained('pizzeria')->onDelete('cascade');
        $table->foreignId('id_bebida')->constrained('bebidas')->onDelete('cascade');
        $table->foreignId('id_postre')->constrained('postres')->onDelete('cascade');
        $table->foreignId('id_comprador')->constrained('usuarios')->onDelete('cascade');
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
