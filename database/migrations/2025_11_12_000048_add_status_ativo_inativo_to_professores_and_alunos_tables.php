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
        });

        Schema::table('professores', function (Blueprint $table) {
            if (!Schema::hasColumn('professores', 'ativo')) {
                $table->boolean('ativo')->default(true)->after('foto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            if (Schema::hasColumn('alunos', 'ativo')) {
                $table->dropColumn('ativo');
            }
        });

        Schema::table('professores', function (Blueprint $table) {
            if (Schema::hasColumn('professores', 'ativo')) {
                $table->dropColumn('ativo');
            }
        });
    }
};
