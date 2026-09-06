<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('postres', function (Blueprint $table) {
        $table->id(); // Llave primaria estándar de Laravel
        
        // 🔥 COLUMNAS WALMART ADAPTADAS (Permiten marcas, stock dinámico y estatus)
        $table->string('nombre_postre');
        $table->string('marca')->default('Genérico'); // Tu nueva columna de marcas
        $table->double('postre_precio');
        $table->string('postre_imagen')->nullable();
        $table->integer('stock')->default(20); // Tu nueva columna de inventario inicial
        $table->boolean('vendido')->default(false); // Cambiado a booleano nativo (0 o 1)
        
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
        Schema::dropIfExists('postre');
    }
}
