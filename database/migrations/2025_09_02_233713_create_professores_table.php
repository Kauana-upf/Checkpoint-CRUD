<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // Cria tabela de professores
    public function up(): void
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id(); // PK da tabela professores
            $table->string('nome'); // nome do professor
            $table->string('email')->unique(); // email único do professor
            // FK para disciplina: relacionamento obrigatório, cascade para deletar professor se disciplina for removida
            $table->foreignId('disciplina_id')
                  ->constrained('disciplinas', 'id_disciplina')
                  ->onDelete('cascade');
            $table->timestamps(); // created_at e updated_at
        });
    }

    // Remove tabela no rollback
    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
