@extends('layouts.layout_principal')

@section('title', 'Alunos - Boletim Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Alunos</h2>
                <a href="{{ route('alunos.create') }}" class="btn btn-primary">+ Novo Aluno</a>
            </div>

            @if ($alunos->isEmpty())
                <p>Nenhum aluno cadastrado.</p>
            @else
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)
                            <tr @if (!$aluno->ativo) style="opacity: 0.6; color: red;" @endif>
                                <td>{{ $aluno->id_aluno }}</td>
                                <td>{{ $aluno->nome }}</td>
                                <td>{{ $aluno->data_nascimento }}</td>
                                <td>{{ $aluno->email }}</td>
                                <td>
                                    @if ($aluno->foto)
                                        <img src="{{ asset('storage/' . $aluno->foto) }}" alt="{{ $aluno->nome }}"
                                            style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                                    @else
                                        <span class="text-muted">Sem foto</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($aluno->ativo)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('alunos.show', $aluno) }}" class="link text-primary me-2">Ver</a>
                                    <a href="{{ route('alunos.edit', $aluno) }}" class="link text-warning me-2">Editar</a>
                                    <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
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

                @if ($alunos->hasPages())
                    <div class="pagination d-flex justify-content-between align-items-center mt-3">
                        <div class="pagination-info text-muted">
                            {{ $alunos->firstItem() }}–{{ $alunos->lastItem() }} de {{ $alunos->total() }}
                        </div>
                        <div class="pagination-links">
                            {{ $alunos->links() }}
                        </div>
                    </div>
                @endif
            @endif

            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-excluir').forEach(botao => {
            botao.addEventListener('click', function() {
                const form = this.closest('form');
                const nome = this.dataset.nome;

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
