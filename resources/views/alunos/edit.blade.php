@extends('layouts.layout_principal')

@section('title', 'Editar Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Editar Aluno</h1>

            {{-- Formulário de edição do aluno --}}
            {{-- action chama a rota alunos.update, que executa o método update no controller --}}
            {{-- method="POST" é obrigatório em formulários, mas usamos @method('PUT') para indicar uma atualização --}}
            {{-- PUT é usado para *ATUALIZAR* dados existentes (POST é para criar novos) --}}
            <form action="{{ route('alunos.update', $aluno) }}" method="POST" class="d-flex flex-column gap-3">
                @csrf
                @method('PUT') {{-- indica atualização! --}}

                <div class="form-group">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $aluno->nome) }}" required>
                </div>

                <div class="form-group">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento', $aluno->data_nascimento) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $aluno->email ?? '') }}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    {{-- Volta para a lista de alunos --}}
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>

                    {{-- Atualiza os dados do aluno --}}
                    <button type="submit" class="btn btn-warning btn-custom">Atualizar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
