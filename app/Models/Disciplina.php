<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $table = 'disciplinas';
    protected $primaryKey = 'id_disciplina';
    public $timestamps = true;

    // Adicione carga_horaria e descricao ao fillable
    protected $fillable = ['nome', 'carga_horaria', 'descricao'];
}
