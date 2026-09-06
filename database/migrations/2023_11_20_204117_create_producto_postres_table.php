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
            $table->integer('cantidad_comprada');

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
        Schema::dropIfExists('producto_postres');
    }
}
