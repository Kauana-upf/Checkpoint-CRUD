@extends('layouts.layout_principal')

@section('title', 'Notas - Boletim Escolar')

@section('content')
    <main>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Notas</h1>
                <a href="{{ route('notas.create') }}" class="btn btn-dark btn-custom">Cadastrar Nota</a>
            </div>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Aluno</th>
                        <th>Disciplina</th>
                        <th>Nota</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr>
                            <td>{{ $nota->aluno->nome }}</td>
                            <td>{{ $nota->disciplina->nome }}</td>
                            <td>{{ $nota->nota }}</td>
                            <td>
                                <a href="{{ route('notas.edit', $nota->id_nota) }}" class="link yellow">Editar</a>
                                <form action="{{ route('notas.destroy', $nota->id_nota) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-excluir link red"
                                        data-nome="{{ $nota->aluno->nome }}">Excluir</button>
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
