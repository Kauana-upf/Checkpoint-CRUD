<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id('id_disciplina'); // define a chave primária personalizada
            $table->string('nome', 100); // nome da disciplina
            $table->integer('carga_horaria'); // carga horária em horas
            $table->text('descricao')->nullable(); // descrição opcional da disciplina
            $table->timestamps(); // created_at e updated_at automáticos
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disciplinas'); // remove a tabela em rollback
    }
};
