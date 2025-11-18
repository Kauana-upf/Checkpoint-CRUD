<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Adiciona coluna foto na tabela alunos
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('email'); 
            // Nullable pois o upload é opcional
            // after('email') define a posição da coluna na tabela
        });
    }

    // Remove coluna foto caso seja feito rollback
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('foto'); 
        });
    }
};
