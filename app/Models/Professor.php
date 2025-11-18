<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professores'; // Define a tabela do banco (essencial)
    protected $primaryKey = 'id_professor'; // Chave primária personalizada

    // Campos permitidos para preenchimento em massa
    protected $fillable = [
        'nome',           // Nome do professor
        'email',          // Email do professor
        'disciplina_id',  // FK para Disciplina
        'foto',           // Foto do professor (opcional)
        'ativo',          // Status: 1 = ativo, 0 = inativo
    ];

    public function disciplina()
    {
        // Relacionamento "muitos para um" com Disciplina
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id_disciplina');
    }
}
