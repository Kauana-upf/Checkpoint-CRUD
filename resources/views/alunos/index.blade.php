@extends('layouts.layout_principal')

@section('title', 'Alunos - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Alunos</h1>
                <a href="{{ route('alunos.create') }}" class="btn btn-dark btn-custom">Novo Aluno</a>
            </div>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id_aluno }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->data_nascimento }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>
                                <a href="{{ route('alunos.show', $aluno) }}" class="link blue">Ver</a>
                                <a href="{{ route('alunos.edit', $aluno) }}" class="link yellow">Editar</a>
                                <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-excluir link red"
                                        data-nome="{{ $aluno->nome }}">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-end">
            <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
        </div>
    </main>
@endsection
