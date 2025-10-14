<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';
    protected $primaryKey = 'id_nota';
    public $timestamps = true;

    // Ajuste os campos para os nomes corretos na tabela
    protected $fillable = ['id_aluno', 'id_disciplina', 'nota'];

    public function aluno()
    {
        // Relacionamento com a tabela alunos
        return $this->belongsTo(Aluno::class, 'id_aluno', 'id_aluno');
    }

    public function disciplina()
    {
        // Relacionamento com a tabela disciplinas
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id_disciplina');
    }
}
