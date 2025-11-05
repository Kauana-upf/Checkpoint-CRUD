@extends('layouts.layout_principal')

@section('title', 'Cadastrar Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Cadastrar Aluno</h1>

            {{-- Exibe mensagens de erro originadas da validação do formulário --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form. de cadastro de aluno --}}
            {{-- "action" chama a rota alunos.store que executa o método store do controller --}}
            {{-- "method=POST" é usado porque estamos ENVIANDO dados para o servidor --}}
            {{-- lembrete: POST cria ou grava algo novo no banco, enquanto GET apenas lê dados --}}
            <form action="{{ route('alunos.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    {{-- Volta para a lista de alunos --}}
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>

                    {{-- Envia o formulário para salvar o novo aluno --}}
                    <button type="submit" class="btn btn-dark btn-custom">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
