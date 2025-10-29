@extends('layouts.layout_principal')

@include('layouts.header')

<x-layouts.app>

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>Detalhes da Nota</h1>

        <div class="form-group">
            <label><strong>ID:</strong></label>
            <p>{{ $nota->id }}</p>
        </div>

        <div class="form-group">
            <label><strong>Aluno:</strong></label>
            <p>{{ $nota->aluno->nome }}</p>
        </div>

        <div class="form-group">
            <label><strong>Disciplina:</strong></label>
            <p>{{ $nota->disciplina->nome }}</p>
        </div>

        <div class="form-group">
            <label><strong>Nota:</strong></label>
            <p>{{ $nota->nota }}</p>
        </div>

        <div class="form-actions">
            <a href="{{ route('notas.edit', $nota) }}" class="btn yellow">Editar</a>
            <a href="{{ route('notas.index') }}" class="btn gray">Voltar</a>
        </div>
    </div>
</x-layouts.app>
