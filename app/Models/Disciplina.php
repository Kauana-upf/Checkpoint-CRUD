<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    // Define a tabela correspondente no banco
    protected $table = 'disciplinas';

    // Define a chave primária personalizada
    protected $primaryKey = 'id_disciplina';

    // Habilita timestamps (created_at e updated_at)
    public $timestamps = true;

    // Campos permitidos para preenchimento em massa (fillable)
    protected $fillable = [
        'nome',           // obrigatório
        'carga_horaria',  // obrigatório
        'descricao',      // facultativo
    ];
}
