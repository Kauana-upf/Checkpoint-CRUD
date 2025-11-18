<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Cria a tabela de professores com chave estrangeira
    public function up(): void
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id('id_professor'); // Chave primária personalizada (não usar id padrão)
            $table->string('nome'); // Nome do professor
            $table->string('email')->unique(); // Email único para login ou contato
            $table->unsignedBigInteger('disciplina_id'); // FK para disciplina (obrigatório: relacionamento)
            $table->string('foto')->nullable(); // Upload de foto (opcional)
            $table->timestamps(); // created_at e updated_at

            // Define a relação de chave estrangeira com disciplinas
            // onDelete cascade: se disciplina for deletada, professor relacionado também é removido
            $table->foreign('disciplina_id')
                ->references('id_disciplina')
                ->on('disciplinas')
                ->onDelete('cascade');
        });
    }

    // Remove a tabela caso seja necessário rollback
    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
