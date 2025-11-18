<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // HasFactory para factories, Notifiable para notificações

    // Campos permitidos para preenchimento em massa
    protected $fillable = [
        'name',      // Nome do usuário
        'email',     // Email do usuário
        'password',  // Senha do usuário (armazenada de forma segura)
    ];

    // Campos que devem ser ocultos na serialização (ex: JSON)
    protected $hidden = [
        'password',
        'remember_token', // token de sessão
    ];

    // Campos que devem ser convertidos automaticamente
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // converte timestamp
            'password' => 'hashed',            // criptografa automaticamente
        ];
    }

    // Retorna as iniciais do usuário (ex: João Silva -> JS)
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')             // separa por espaços
            ->take(2)                  // pega as duas primeiras palavras
            ->map(fn ($word) => Str::substr($word, 0, 1)) // pega a primeira letra de cada
            ->implode('');             // une em uma string
    }
}
