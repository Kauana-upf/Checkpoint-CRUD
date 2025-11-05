@extends('layouts.layout_principal')

@section('title', 'Detalhes do Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detalhes do Aluno</h1>

                {{-- route('alunos.index') chama o método index do controller --}}
                {{-- GET é usado porque apenas exibe a lista, sem enviar dados --}}
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>

            {{-- Exibe os dados do aluno vindos do banco --}}
            <div class="mb-3"><strong>ID:</strong> {{ $aluno->id_aluno }}</div>
            <div class="mb-3"><strong>Nome:</strong> {{ $aluno->nome }}</div>
            <div class="mb-3"><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento }}</div>
            <div class="mb-3"><strong>Email:</strong> {{ $aluno->email }}</div>

            <div class="d-flex gap-2 mt-4">

                {{-- route('alunos.edit') usa GET porque apenas mostra o formulário de edição --}}
                <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-warning btn-custom">Editar</a>

                {{-- method="POST" é padrão de formulários --}}
                <form action="{{ route('alunos.destroy', $aluno) }}" method="POST"
                    onsubmit="return confirm('Deseja realmente excluir este aluno?');">
                    @csrf {{-- Protege contra ataques CSRF --}}
                    @method('DELETE') {{-- Informa ao Laravel que é uma exclusão --}}
                    <button class="btn btn-danger btn-custom">Excluir</button>
                </form>
            </div>
        </div>
    </main>
@endsection
