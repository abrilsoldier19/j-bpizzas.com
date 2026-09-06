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
            $table->string('marca')->default('Genérico'); // Para poner 'Coca-Cola', 'Pepsi', etc.
            $table->double('precio_pizza');
            $table->string('imagen_pizza')->nullable();
            $table->text('descripcion_pizza')->nullable(); 
            $table->integer('stock')->default(20); // Inventario inicial de refrescos
            $table->boolean('vendido')->default(false); // Interruptor de agotado (0 disponible, 1 agotado)
        
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
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
