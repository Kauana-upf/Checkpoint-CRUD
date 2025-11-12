@extends('layouts.layout_principal') {{-- Usa o layout principal padrão --}}

@section('title', 'Disciplinas - Boletim Escolar Online') {{-- Define o título da aba --}}

@section('content')
    {{-- Importa o CSS principal --}}
    {{-- asset() busca o arquivo dentro de public/css --}}

    <head>
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
        {{-- table-bordered e text-center são classes do Bootstrap --}}
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
                    {{-- foreach percorre todas as disciplinas enviadas pelo controller --}}
                    @foreach ($disciplinas as $disciplina)
                        <tr>
                            {{-- Exibe os dados da disciplina --}}
                            <td>{{ $disciplina->id_disciplina ?? $disciplina->id }}</td>
                            <td>{{ $disciplina->nome }}</td>
                            <td>{{ $disciplina->carga_horaria }}</td>

                            {{-- Str::limit corta a descrição para não quebrar o layout --}}
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

                                {{-- POST é obrigatório em formulários, mas com @method('DELETE')
                                     informamos ao Laravel que é uma exclusão --}}
                                <form
                                    action="{{ route('disciplinas.destroy', $disciplina->id_disciplina ?? $disciplina->id) }}"
                                    method="POST" class="form-excluir">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Botão não envia direto — SweetAlert confirma antes --}}
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

            {{-- Paginação das disciplinas --}}
            @if ($disciplinas->hasPages())
                <div class="pagination">
                    <div class="pagination-info">
                        {{ $disciplinas->firstItem() }}–{{ $disciplinas->lastItem() }}
                        de {{ $disciplinas->total() }}
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

    {{-- Script SweetAlert2 para confirmação ao excluir --}}
    {{-- Necessário pois DELETE não deve ser feito sem confirmação --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Espera o carregamento completo da página
        document.addEventListener("DOMContentLoaded", function() {
            // Seleciona todos os botões de exclusão
            document.querySelectorAll('.btn-excluir').forEach(button => {
                button.addEventListener('click', function() {
                    const nome = this.getAttribute('data-nome');
                    const form = this.closest('form'); // pega o form correto

                    // Exibe alerta de confirmação
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
                        // Se confirmado, envia o formulário
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
