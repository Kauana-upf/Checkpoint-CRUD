@extends('layouts.layout_principal')

@section('title', 'Detalhes da Nota - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4 shadow">
            // Título da página
            <h1 class="mb-4">Detalhes da Nota</h1>

            // Exibe informações da nota
            <div class="form-group mb-2">
                <label><strong>ID:</strong></label>
                <p>{{ $nota->id_nota }}</p>
            </div>

            // FK: exibe nome do aluno vinculado
            <div class="form-group mb-2">
                <label><strong>Aluno:</strong></label>
                <p>{{ $nota->aluno->nome }}</p>
            </div>

            // FK: exibe nome da disciplina vinculada
            <div class="form-group mb-2">
                <label><strong>Disciplina:</strong></label>
                <p>{{ $nota->disciplina->nome }}</p>
            </div>

            <div class="form-group mb-4">
                <label><strong>Nota:</strong></label>
                <p>{{ $nota->nota }}</p>
            </div>

            // Botões
            <div class="d-flex gap-2">
                // GET → apenas exibe o formulário de edição
                <a href="{{ route('notas.edit', $nota->id_nota) }}" class="btn btn-dark btn-custom">Editar</a>

                // DELETE → exclusão com confirmação SweetAlert
                <form action="{{ route('notas.destroy', $nota->id_nota) }}" method="POST" class="d-inline form-excluir">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-custom btn-excluir"
                        data-nome="{{ $nota->aluno->nome }}">Excluir</button>
                </form>

                // GET → apenas redireciona
                <a href="{{ route('notas.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>
        </div>
    </main>

    // Script SweetAlert2 para confirmação ao excluir
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Espera o carregamento completo da página
        document.addEventListener("DOMContentLoaded", function() {
            // Seleciona todos os botões de exclusão
            document.querySelectorAll('.btn-excluir').forEach(button => {
                button.addEventListener('click', function() {
                    const nome = this.getAttribute('data-nome');
                    const form = this.closest('form');

                    // Exibe alerta de confirmação
                    Swal.fire({
                        title: 'Excluir?',
                        text: `Deseja realmente excluir a nota de "${nome}"?`,
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
