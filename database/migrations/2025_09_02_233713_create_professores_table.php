<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id(); // PK da tabela professores
            $table->string('nome');
            $table->string('email')->unique();
            // Ajuste aqui: referência ao nome correto da coluna na tabela disciplinas
            $table->foreignId('disciplina_id')->constrained('disciplinas', 'id_disciplina')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
