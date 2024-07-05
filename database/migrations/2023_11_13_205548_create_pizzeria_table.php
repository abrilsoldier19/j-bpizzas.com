<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzeriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzeria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nombre_id');
            $table->string('columna1image')->nullable();
            $table->string('columna2Image')->nullable();
            $table->string('hora')->timestamps();
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
