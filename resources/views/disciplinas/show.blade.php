@extends('layouts.layout_principal') {{-- Usa o layout principal do site --}}
@include('layouts.header') {{-- Inclui o cabeçalho padrão --}}

@section('title', 'Detalhes da Disciplina - Boletim Escolar Online') {{-- Define o título da aba do navegador --}}

@section('content')
    {{-- Inicia o layout principal da aplicação --}}
    <x-layouts.app :title="'Visualizar Disciplina'">

        {{-- Importa o CSS principal do projeto --}}

        <head>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>

        <div class="container">
            {{-- Exibe o nome da disciplina --}}
            <h1>{{ $disciplina->nome }}</h1>

            {{-- Mostra o ID da disciplina --}}
            <p><strong>ID:</strong> {{ $disciplina->id_disciplina ?? $disciplina->id }}</p>

            {{-- Mostra a carga horária da disciplina --}}
            <p><strong>Carga Horária:</strong> {{ $disciplina->carga_horaria }}</p>

            {{-- Exibe a descrição somente se existir --}}
            @if ($disciplina->descricao)
                <p><strong>Descrição:</strong> {{ $disciplina->descricao }}</p>
            @endif

            {{-- Botões de ação: editar e voltar --}}
            <div class="form-actions">
                {{-- GET: apenas abre o formulário de edição --}}
                <a href="{{ route('disciplinas.edit', $disciplina->id_disciplina ?? $disciplina->id) }}"
                    class="btn yellow">Editar</a>

                {{-- GET: retorna para a lista de disciplinas --}}
                <a href="{{ route('disciplinas.index') }}" class="btn gray">Voltar</a>
            </div>
        </div>
    </x-layouts.app>
@endsection
