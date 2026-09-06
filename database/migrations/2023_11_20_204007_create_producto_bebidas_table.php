<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoBebidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_bebidas', function (Blueprint $table) {
            $table->id('id');

            $table->integer('cantidad_comprada')->default(false);

            $table->foreignId('id_bebida')->constrained('bebidas')->onDelete('cascade');
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
        Schema::dropIfExists('producto_bebidas');
    }
}
