@extends('layouts.layout_principal')

@section('title', 'Detalhes do Professor - Boletim Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            {{-- Título da página --}}
            <h1>Detalhes do Professor</h1>

            {{-- Exibe a foto do professor, se existir --}}
            @if ($professor->foto)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/' . $professor->foto) }}" alt="Foto do Professor" class="img-thumbnail"
                        style="max-width: 200px;">
                </div>
            @endif

            {{-- Informações do professor --}}
            <div class="mt-3">
                <p><strong>ID:</strong> {{ $professor->id_professor ?? $professor->id }}</p>
                <p><strong>Nome:</strong> {{ $professor->nome }}</p>
                <p><strong>Email:</strong> {{ $professor->email }}</p>
                <p><strong>Disciplina:</strong> {{ $professor->disciplina->nome ?? 'Sem disciplina' }}</p>

                {{-- Status --}}
                <p><strong>Status:</strong>
                    @if ($professor->status === 'Ativo')
                        <span class="badge bg-success">Ativo</span>
                    @else
                        <span class="badge bg-danger">Inativo</span>
                    @endif
                </p>
            </div>

            {{-- Botões de ação: editar, excluir e voltar --}}
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('professores.edit', $professor->id_professor ?? $professor->id) }}"
                    class="btn btn-dark btn-custom">Editar</a>

                <form action="{{ route('professores.destroy', $professor->id_professor ?? $professor->id) }}" method="POST"
                    class="d-inline form-excluir">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-excluir btn btn-danger btn-custom" data-nome="{{ $professor->nome }}">
                        Excluir
                    </button>
                </form>

                <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>
        </div>
    </div>

    {{-- Script SweetAlert2 para confirmação de exclusão --}}
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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
