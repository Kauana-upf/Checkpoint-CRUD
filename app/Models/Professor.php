<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professores'; // ESSENCIAL
    protected $primaryKey = 'id_professor';

    protected $fillable = [
        'nome',
        'email',
        'disciplina_id',
        'foto',
        'ativo', // usar somente isso
    ];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id_disciplina');
    }
}
