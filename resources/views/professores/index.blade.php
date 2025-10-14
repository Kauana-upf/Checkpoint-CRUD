@extends('layouts.layout_principal')

@section('title', 'Professores - Boletim Escolar')

@section('content')
    <main>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Professores</h1>
                <a href="{{ route('professores.create') }}" class="btn btn-dark btn-custom">Novo Professor</a>
            </div>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professores as $professor)
                        <tr>
                            <td>{{ $professor->id }}</td>
                            <td>{{ $professor->nome }}</td>
                            <td>{{ $professor->email }}</td>
                            <td>{{ $professor->disciplina->nome ?? 'Sem disciplina' }}</td>
                            <td>
                                <a href="{{ route('professores.show', $professor) }}" class="link blue">Ver</a>
                                <a href="{{ route('professores.edit', $professor) }}" class="link yellow">Editar</a>
                                <form action="{{ route('professores.destroy', $professor) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-excluir link red"
                                        data-nome="{{ $professor->nome }}">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </main>
@endsection
