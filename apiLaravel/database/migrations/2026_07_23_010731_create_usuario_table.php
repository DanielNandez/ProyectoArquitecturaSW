<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id("id_usuario"); //PK por defecto al colocarla de primero
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('documento', 20)->unique();
            $table->integer('edad')->unsigned();
            $table->string('correo', 200)->unique();
            $table->string('contrasena');
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro'])
            ->default('Otro');
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios'); // Eliminar la tabla si existe
    }
};
