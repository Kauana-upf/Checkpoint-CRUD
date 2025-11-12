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
        Schema::create('professores', function (Blueprint $table) {
            $table->id('id_professor'); // chave primária personalizada
            $table->string('nome');
            $table->string('email')->unique();
            $table->unsignedBigInteger('disciplina_id');
            $table->string('foto')->nullable(); // adicionada aqui direto
            $table->timestamps();

            // Relacionamento com a tabela disciplinas
            $table->foreign('disciplina_id')
                ->references('id_disciplina')
                ->on('disciplinas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
