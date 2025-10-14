<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
    $table->id('id_nota');
    $table->unsignedBigInteger('id_aluno');
    $table->unsignedBigInteger('id_disciplina');
    $table->decimal('nota', 5, 2);
    $table->timestamps();

    $table->foreign('id_aluno')->references('id_aluno')->on('alunos')->onDelete('cascade');
    $table->foreign('id_disciplina')->references('id_disciplina')->on('disciplinas')->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
