<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoPostresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_postres', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_postre');
            $table->bigInteger('id_comprador');

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
        Schema::dropIfExists('producto_postres');
    }
}
