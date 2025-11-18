@extends('layouts.layout_principal') // Usa o layout principal padrão

@section('title', 'Disciplinas - Boletim Escolar Online') // Define o título da aba

@section('content')

    <head>
        {{-- Importa o CSS principal --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container py-4">
        {{-- Cabeçalho com título e botão de nova disciplina --}}
        {{-- GET usado pois só abre o formulário --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h1 class="m-0">Disciplinas</h1>
            <a href="{{ route('disciplinas.create') }}" class="btn btn-dark btn-custom">Nova Disciplina</a>
        </div>

        {{-- Tabela com todas as disciplinas --}}
        <div class="table-responsive mb-4">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Carga Horária</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Percorre todas as disciplinas enviadas pelo controller --}}
                    @foreach ($disciplinas as $disciplina)
                        <tr>
                            <td>{{ $disciplina->id_disciplina ?? $disciplina->id }}</td>
                            <td>{{ $disciplina->nome }}</td>
                            <td>{{ $disciplina->carga_horaria }}</td>
                            {{-- Limita a descrição para não quebrar o layout --}}
                            <td title="{{ $disciplina->descricao }}">
                                {{ Str::limit($disciplina->descricao, 80) }}
                            </td>

                            {{-- Botões de ação --}}
                            <td class="d-flex justify-content-center gap-2">
                                {{-- GET usado porque apenas mostra --}}
                                <a href="{{ route('disciplinas.show', $disciplina->id_disciplina ?? $disciplina->id) }}"
                                    class="btn btn-sm btn-primary">Ver</a>

                                {{-- GET usado para abrir formulário de edição --}}
                                <a href="{{ route('disciplinas.edit', $disciplina->id_disciplina ?? $disciplina->id) }}"
                                    class="btn btn-sm btn-warning">Editar</a>

                                {{-- DELETE via formulário --}}
                                <form
                                    action="{{ route('disciplinas.destroy', $disciplina->id_disciplina ?? $disciplina->id) }}"
                                    method="POST" class="form-excluir">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Botão só dispara SweetAlert --}}
                                    <button type="button" class="btn btn-sm btn-danger btn-excluir"
                                        data-nome="{{ $disciplina->nome }}">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Paginação --}}
            @if ($disciplinas->hasPages())
                <div class="pagination">
                    <div class="pagination-info">
                        {{ $disciplinas->firstItem() }}–{{ $disciplinas->lastItem() }} de {{ $disciplinas->total() }}
                    </div>
                    <div class="pagination-links">
                        {{ $disciplinas->links() }}
                    </div>
                </div>
            @endif
        </div>

        {{-- Botão para voltar à dashboard --}}
        <div class="mt-3 text-end">
            <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
        </div>
    </div>

    {{-- SweetAlert2 para confirmação de exclusão --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.btn-excluir').forEach(button => {
                button.addEventListener('click', function() {
                    const nome = this.getAttribute('data-nome');
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Excluir?',
                        text: `Deseja realmente excluir "${nome}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Cancelar'
                    }).then(result => {
                        if (result.isConfirmed) {
                            form.submit(); // envia DELETE após confirmação
                        }
                    });
                });
            });
        });
    </script>
@endsection
