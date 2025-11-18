@extends('layouts.layout_principal') // Usa o layout principal do site
@include('layouts.header') // Inclui o cabeçalho padrão

@section('title', 'Detalhes da Disciplina - Boletim Escolar Online') // Define o título da aba

@section('content')
    <x-layouts.app :title="'Visualizar Disciplina'"> // Layout principal da página

        <head>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}"> // Importa o CSS principal
        </head>

        <div class="container py-4">
            <h1 class="mb-3">{{ $disciplina->nome }}</h1> // Nome da disciplina

            <p><strong>ID:</strong> {{ $disciplina->id_disciplina ?? $disciplina->id }}</p> // ID da disciplina

            <p><strong>Carga Horária:</strong> {{ $disciplina->carga_horaria }}</p> // Carga horária

            @if ($disciplina->descricao)
                <p><strong>Descrição:</strong> {{ $disciplina->descricao }}</p> // Descrição, se houver
            @endif

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('disciplinas.edit', $disciplina->id_disciplina ?? $disciplina->id) }}"
                    class="btn btn-dark btn-custom">Editar</a> // Botão de edição

                <form action="{{ route('disciplinas.destroy', $disciplina->id_disciplina ?? $disciplina->id) }}"
                    method="POST" class="d-inline form-excluir">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-custom btn-excluir"
                        data-nome="{{ $disciplina->nome }}">Excluir</button> // Botão de exclusão com SweetAlert
                </form>

                <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary btn-custom">Voltar</a> // Voltar à lista
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> // SweetAlert2
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.btn-excluir').forEach(button => {
                    button.addEventListener('click', function() {
                        const nome = this.getAttribute('data-nome');
                        const form = this.closest('form');

                        Swal.fire({ // Confirmação antes de excluir
                            title: 'Excluir?',
                            text: `Deseja realmente excluir a disciplina "${nome}"?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Sim',
                            cancelButtonText: 'Cancelar'
                        }).then(result => {
                            if (result.isConfirmed) form.submit(); // Executa exclusão
                        });
                    });
                });
            });
        </script>
    </x-layouts.app>
@endsection
