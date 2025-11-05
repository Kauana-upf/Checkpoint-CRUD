@extends('layouts.layout_principal')

@section('title', 'Detalhes do Professor - Boletim Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h1>Detalhes do Professor</h1>

            {{-- Exibe os dados do professor --}}
            <div class="mt-3">
                <p><strong>ID:</strong> {{ $professor->id }}</p>
                <p><strong>Nome:</strong> {{ $professor->nome }}</p>
                <p><strong>Email:</strong> {{ $professor->email }}</p>
                <p><strong>Disciplina:</strong> {{ $professor->disciplina->nome ?? 'Sem disciplina' }}</p>
            </div>

            {{-- Botões de ação --}}
            <div class="mt-4 d-flex gap-2">
                {{-- GET → apenas exibe o formulário de edição --}}
                <a href="{{ route('professores.edit', $professor) }}" class="btn btn-dark btn-custom">Editar</a>

                {{-- DELETE → remove o professor --}}
                <form action="{{ route('professores.destroy', $professor) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-excluir btn btn-danger btn-custom" data-nome="{{ $professor->nome }}">
                        Excluir
                    </button>
                </form>

                {{-- GET → apenas redireciona --}}
                <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
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
