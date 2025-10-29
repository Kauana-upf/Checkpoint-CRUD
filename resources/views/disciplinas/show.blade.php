@extends('layouts.layout_principal')
@include('layouts.header')

@section('title', 'Detalhes da Disciplina - Boletim Escolar Online')

@section('content')

    <x-layouts.app :title="'Visualizar Disciplina'">

        <head>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>

        <div class="container">
            <h1>{{ $disciplina->nome }}</h1>

            <p><strong>Carga Horária:</strong> {{ $disciplina->carga_horaria }}</p>

            @if ($disciplina->descricao)
                <p><strong>Descrição:</strong> {{ $disciplina->descricao }}</p>
            @endif

            <div class="form-actions">
                <a href="{{ route('disciplinas.edit', $disciplina->id_disciplina) }}" class="btn yellow">Editar</a>
                <a href="{{ route('disciplinas.index') }}" class="btn gray">Voltar</a>
            </div>

            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </x-layouts.app>
@endsection
