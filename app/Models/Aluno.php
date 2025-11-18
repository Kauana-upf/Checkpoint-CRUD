<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    // Define a tabela correspondente no banco
    protected $table = 'alunos';

    // Define a chave primária personalizada
    protected $primaryKey = 'id_aluno';

    // Habilita timestamps (created_at e updated_at)
    public $timestamps = true;

    // Campos permitidos para preenchimento em massa (fillable)
    protected $fillable = [
        'nome',             // obrigatório
        'data_nascimento',  // obrigatório
        'email',            // obrigatório
        'foto',             // facultativo
        'ativo',            // obrigatório, permite ativar/inativar
    ];
}
