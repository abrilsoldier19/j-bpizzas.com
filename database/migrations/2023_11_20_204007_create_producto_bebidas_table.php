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
            $table->unsignedBigInteger('id_bebida');
            $table->bigInteger('id_comprador');

        $table->foreign('id_bebida')->references('id')->on('bebidas')->onDelete('cascade');
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
        Schema::dropIfExists('producto_bebidas');
    }
}
