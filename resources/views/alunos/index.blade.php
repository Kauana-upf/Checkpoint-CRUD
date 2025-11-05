@extends('layouts.layout_principal')

@section('title', 'Alunos - Boletim Escolar Online')

@section('content')
    {{-- container e card usados para manter o mesmo estilo do CRUD de notas --}}
    <div class="container mt-4">
        <div class="card shadow p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Alunos</h2>

                {{-- Botão para cadastrar novo aluno --}}
                {{-- route('alunos.create') chama o método create no controller --}}
                {{-- método usa GET pois apenas exibe o formulário --}}
                <a href="{{ route('alunos.create') }}" class="btn btn-primary">+ Novo Aluno</a>
            </div>

            {{-- Verifica se existem alunos cadastrados --}}
            @if ($alunos->isEmpty())
                <p>Nenhum aluno cadastrado.</p>
            @else
                {{-- Tabela estilizada com bootstrap, igual ao CRUD de notas --}}
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Percorre todos os alunos enviados pelo controller --}}
                        @foreach ($alunos as $aluno)
                            <tr>
                                {{-- Exibe os dados do aluno --}}
                                <td>{{ $aluno->id_aluno }}</td>
                                <td>{{ $aluno->nome }}</td>
                                <td>{{ $aluno->data_nascimento }}</td>
                                <td>{{ $aluno->email }}</td>
                                <td>
                                    {{-- route('alunos.show') chama o método show do controller --}}
                                    {{-- GET usado porque apenas mostra as informações --}}
                                    <a href="{{ route('alunos.show', $aluno) }}" class="link text-primary me-2">Ver</a>

                                    {{-- route('alunos.edit') chama o método edit --}}
                                    {{-- GET usado porque só exibe o formulário de edição --}}
                                    <a href="{{ route('alunos.edit', $aluno) }}" class="link text-warning me-2">Editar</a>

                                    {{-- Formulário para exclusão do aluno --}}
                                    {{-- method="POST" é obrigatório, mas @method('DELETE') indica ao Laravel que é uma exclusão --}}
                                    <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        {{-- Botão que chama alerta de confirmação antes de excluir --}}
                                        <button type="button"
                                            class="btn-excluir link text-danger border-0 bg-transparent p-0"
                                            data-nome="{{ $aluno->nome }}">
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
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>

    {{-- Script para confirmação antes de excluir (SweetAlert) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Seleciona todos os botões de exclusão
        document.querySelectorAll('.btn-excluir').forEach(botao => {
            botao.addEventListener('click', function() {
                const form = this.closest('form');
                const nome = this.dataset.nome;

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
    </script>
@endsection
