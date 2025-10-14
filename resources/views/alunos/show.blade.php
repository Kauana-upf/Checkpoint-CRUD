@extends('layouts.layout_principal')

@section('title', 'Detalhes do Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detalhes do Aluno</h1>
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>

            <div class="mb-3"><strong>ID:</strong> {{ $aluno->id_aluno }}</div>
            <div class="mb-3"><strong>Nome:</strong> {{ $aluno->nome }}</div>
            <div class="mb-3"><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento }}</div>
            <div class="mb-3"><strong>Email:</strong> {{ $aluno->email }}</div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-warning btn-custom">Editar</a>
                <form action="{{ route('alunos.destroy', $aluno) }}" method="POST"
                    onsubmit="return confirm('Deseja realmente excluir este aluno?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-custom">Excluir</button>
                </form>
            </div>
            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </main>
@endsection
