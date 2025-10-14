<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    // Definindo a tabela correta
    protected $table = 'professores';

    // Campos que podem ser preenchidos via create/store
    protected $fillable = ['nome', 'email', 'disciplina_id'];

    // Relacionamento com Disciplina
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id_disciplina');
    }
}
