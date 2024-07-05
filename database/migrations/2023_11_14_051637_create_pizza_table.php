<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzeria', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre_pizza');
            $table->double('precio_pizza');
            $table->string('imagen_pizza')->nullable();
            $table->boolean('vendido')->default(false);
            $table->bigInteger('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzeria');
    }
}
