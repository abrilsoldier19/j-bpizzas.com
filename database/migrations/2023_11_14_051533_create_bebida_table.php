<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBebidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('bebidas', function (Blueprint $table) {
        $table->id();
        
        // 🥤 COLUMNAS WALMART PARA BEBIDAS
        $table->string('nombre_bebida');
        $table->string('marca')->default('Genérico'); // Para poner 'Coca-Cola', 'Pepsi', etc.
        $table->double('bebida_precio');
        $table->string('bebida_imagen')->nullable();
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
        Schema::dropIfExists('bebida');
    }
}
