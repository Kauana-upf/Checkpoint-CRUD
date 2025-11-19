<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    // Define a tabela correspondente no banco
    protected $table = 'professores';

    // Define a chave primária personalizada
    protected $primaryKey = 'id';

    // Habilita timestamps (created_at e updated_at)
    public $timestamps = true;

    // Campos permitidos para preenchimento em massa
    protected $fillable = [
        'nome',           // obrigatório
        'email',          // obrigatório
        'disciplina_id',  // obrigatório, FK para disciplina
        'foto',           // facultativo
        'status',         // obrigatório, Ativo/Inativo
    ];

    // Relacionamento com disciplina (muitos para um)
    public function disciplina()
    {
        // Corrigido: coluna na tabela disciplinas é 'id_disciplina'
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id_disciplina');
    }
}
