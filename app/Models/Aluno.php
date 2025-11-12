<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';
    protected $primaryKey = 'id_aluno';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'email',
        'foto',
        'status', // novo campo
    ];
}
