@extends('layouts.layout_principal')

@section('title', 'Detalhes do Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detalhes do Aluno</h1>
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>

            <div class="mb-3"><strong>ID:</strong> {{ $aluno->id_aluno }}</div>
            <div class="mb-3"><strong>Nome:</strong> {{ $aluno->nome }}</div>
            <div class="mb-3"><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento }}</div>
            <div class="mb-3"><strong>Email:</strong> {{ $aluno->email }}</div>
            <div class="mb-3">
                <strong>Foto:</strong>
                @if ($aluno->foto)
                    <img src="{{ asset('storage/' . $aluno->foto) }}" alt="{{ $aluno->nome }}"
                        style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                @else
                    <span class="text-muted">Sem foto</span>
                @endif
            </div>

            {{-- EXIBIÇÃO DO STATUS --}}
            <div class="mb-3">
                <strong>Status:</strong>
                @if ($aluno->status === 'ativo')
                    <span class="badge bg-success">Ativo</span>
                @else
                    <span class="badge bg-danger">Inativo</span>
                @endif
            </div>

            {{-- FORMULÁRIO PARA ALTERAR STATUS --}}
            <form action="{{ route('alunos.alterarStatus', $aluno->id_aluno) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    {{ $aluno->status === 'ativo' ? 'Desativar Aluno' : 'Ativar Aluno' }}
                </button>
            </form>

            <hr class="my-4">

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-warning btn-custom">Editar</a>
                <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="form-excluir">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-custom btn-excluir" data-nome="{{ $aluno->nome }}">
                        Excluir
                    </button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.btn-excluir').forEach(button => {
                    button.addEventListener('click', function() {
                        const nome = this.getAttribute('data-nome');
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Excluir?',
                            text: `Deseja realmente excluir o aluno "${nome}"?`,
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
            });
        </script>
    </main>
@endsection
