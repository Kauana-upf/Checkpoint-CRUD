<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Adiciona novas colunas na tabela (ativo e status)
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            // Coluna boolean para marcar se o aluno está ativo (facultativo, usado para filtro)
            if (!Schema::hasColumn('alunos', 'ativo')) {
                $table->boolean('ativo')->default(true)->after('foto');
            }

            // Coluna enum para exibir status textual (Ativo/Inativo), útil para interface
            if (!Schema::hasColumn('alunos', 'status')) {
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo')->after('ativo');
            }
        });

        Schema::table('professores', function (Blueprint $table) {
            // Mesma lógica para professores
            if (!Schema::hasColumn('professores', 'ativo')) {
                $table->boolean('ativo')->default(true)->after('foto');
            }

            if (!Schema::hasColumn('professores', 'status')) {
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo')->after('ativo');
            }
        });
    }

    // Remove as colunas adicionadas (rollback)
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            if (Schema::hasColumn('alunos', 'status')) {
                $table->dropColumn('status'); // remove status textual
            }

            if (Schema::hasColumn('alunos', 'ativo')) {
                $table->dropColumn('ativo'); // remove campo boolean
            }
        });

        Schema::table('professores', function (Blueprint $table) {
            if (Schema::hasColumn('professores', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('professores', 'ativo')) {
                $table->dropColumn('ativo');
            }
        });
    }
};
