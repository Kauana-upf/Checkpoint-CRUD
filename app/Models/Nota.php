<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    // Define a tabela correspondente no banco
    protected $table = 'notas';

    // Define a chave primária personalizada
    protected $primaryKey = 'id_nota';

    // Habilita timestamps (created_at e updated_at)
    public $timestamps = true;

    // Campos permitidos para preenchimento em massa
    protected $fillable = [
        'id_aluno',       // FK para Aluno (obrigatório)
        'id_disciplina',  // FK para Disciplina (obrigatório)
        'nota',           // Valor da nota (obrigatório)
    ];

    public function aluno()
    {
        // Relacionamento "muitos para um" com Aluno
        return $this->belongsTo(Aluno::class, 'id_aluno', 'id_aluno');
    }

    public function disciplina()
    {
        // Relacionamento "muitos para um" com Disciplina
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id_disciplina');
    }
}
