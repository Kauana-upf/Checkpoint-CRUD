<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Cria tabela de notas com relacionamento com alunos e disciplinas
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id('id_nota'); // chave primária personalizada
            $table->unsignedBigInteger('id_aluno'); // FK para alunos
            $table->unsignedBigInteger('id_disciplina'); // FK para disciplinas
            $table->decimal('nota', 5, 2); // nota do aluno, até 999.99
            $table->timestamps(); // created_at e updated_at

            // Define chaves estrangeiras com exclusão em cascata
            $table->foreign('id_aluno')
                  ->references('id_aluno')
                  ->on('alunos')
                  ->onDelete('cascade');

            $table->foreign('id_disciplina')
                  ->references('id_disciplina')
                  ->on('disciplinas')
                  ->onDelete('cascade');
        });
    }

    // Remove tabela de notas no rollback
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
