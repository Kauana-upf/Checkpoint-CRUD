<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // chave primária
            $table->string('nome_usuario', 100);
            $table->string('senha'); // armazenar criptografada (bcrypt)
            $table->enum('tipo_usuario', ['professor', 'admin'])->default('professor');
            $table->rememberToken(); // para login
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
