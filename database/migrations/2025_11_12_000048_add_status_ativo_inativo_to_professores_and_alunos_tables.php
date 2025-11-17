<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            if (!Schema::hasColumn('alunos', 'ativo')) {
                $table->boolean('ativo')->default(true)->after('foto');
            }

            if (!Schema::hasColumn('alunos', 'status')) {
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo')->after('ativo');
            }
        });

        Schema::table('professores', function (Blueprint $table) {
            if (!Schema::hasColumn('professores', 'ativo')) {
                $table->boolean('ativo')->default(true)->after('foto');
            }

            if (!Schema::hasColumn('professores', 'status')) {
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo')->after('ativo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            if (Schema::hasColumn('alunos', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('alunos', 'ativo')) {
                $table->dropColumn('ativo');
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
