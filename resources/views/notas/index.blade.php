@extends('layouts.layout_principal')

@section('title', 'Notas - Boletim Escolar')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Notas</h2>
                <a href="{{ route('notas.create') }}" class="btn btn-primary">+ Nova Nota</a>
            </div>

            @if ($notas->isEmpty())
                <p>Nenhuma nota cadastrada.</p>
            @else
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead>
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
                                    <a href="{{ route('notas.edit', $nota->id_nota) }}"
                                        class="link text-warning me-2">Editar</a>
                                    <form action="{{ route('notas.destroy', $nota->id_nota) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-excluir link text-danger border-0 bg-transparent p-0"
                                            data-nome="{{ $nota->aluno->nome }}">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
