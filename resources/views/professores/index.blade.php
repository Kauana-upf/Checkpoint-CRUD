@extends('layouts.layout_principal')

@section('title', 'Professores - Boletim Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Professores</h1>

                {{-- Botão para cadastrar novo professor --}}
                {{-- route('professores.create') chama o método create no controller --}}
                {{-- GET é usado porque apenas exibe o formulário --}}
                <a href="{{ route('professores.create') }}" class="btn btn-dark btn-custom">+ Novo Professor</a>
            </div>

            {{-- Verifica se há professores cadastrados --}}
            @if ($professores->isEmpty())
                <p>Nenhum professor cadastrado.</p>
            @else
                {{-- Tabela com dados dos professores --}}
                <table class="table table-striped table-bordered text-center align-middle">
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
                        {{-- Percorre todos os professores --}}
                        @foreach ($professores as $professor)
                            <tr>
                                <td>{{ $professor->id }}</td>
                                <td>{{ $professor->nome }}</td>
                                <td>{{ $professor->email }}</td>
                                <td>{{ $professor->disciplina->nome ?? 'Sem disciplina' }}</td>
                                <td>
                                    {{-- GET usado para exibir detalhes --}}
                                    <a href="{{ route('professores.show', $professor) }}"
                                        class="link text-primary me-2">Ver</a>

                                    {{-- GET usado para exibir o formulário de edição --}}
                                    <a href="{{ route('professores.edit', $professor) }}"
                                        class="link text-warning me-2">Editar</a>

                                    {{-- Formulário de exclusão --}}
                                    {{-- method="POST" é obrigatório, mas usamos @method('DELETE') para deletar --}}
                                    <form action="{{ route('professores.destroy', $professor) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-excluir link text-danger border-0 bg-transparent p-0"
                                            data-nome="{{ $professor->nome }}">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- GET usado pois apenas redireciona --}}
            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </div>

    {{-- Script de confirmação SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Confirma exclusão antes de enviar o formulário
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
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
