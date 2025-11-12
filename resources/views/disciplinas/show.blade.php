@extends('layouts.layout_principal') {{-- Usa o layout principal do site --}}
@include('layouts.header') {{-- Inclui o cabeçalho padrão --}}

@section('title', 'Detalhes da Disciplina - Boletim Escolar Online') {{-- Define o título da aba do navegador --}}

@section('content')
    {{-- Inicia o layout principal da aplicação --}}
    <x-layouts.app :title="'Visualizar Disciplina'">

        {{-- Importa o CSS principal do projeto --}}

        <head>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>

        <div class="container py-4">
            {{-- Exibe o nome da disciplina --}}
            <h1 class="mb-3">{{ $disciplina->nome }}</h1>

            {{-- Mostra o ID da disciplina --}}
            <p><strong>ID:</strong> {{ $disciplina->id_disciplina ?? $disciplina->id }}</p>

            {{-- Mostra a carga horária da disciplina --}}
            <p><strong>Carga Horária:</strong> {{ $disciplina->carga_horaria }}</p>

            {{-- Exibe a descrição somente se existir --}}
            @if ($disciplina->descricao)
                <p><strong>Descrição:</strong> {{ $disciplina->descricao }}</p>
            @endif

            {{-- Botões de ação: editar, excluir e voltar --}}
            <div class="d-flex gap-2 mt-4">
                {{-- GET: apenas abre o formulário de edição --}}
                <a href="{{ route('disciplinas.edit', $disciplina->id_disciplina ?? $disciplina->id) }}"
                    class="btn btn-dark btn-custom">Editar</a>

                {{-- DELETE: exclusão com confirmação SweetAlert2 --}}
                <form action="{{ route('disciplinas.destroy', $disciplina->id_disciplina ?? $disciplina->id) }}"
                    method="POST" class="d-inline form-excluir">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-custom btn-excluir"
                        data-nome="{{ $disciplina->nome }}">Excluir</button>
                </form>

                {{-- GET: retorna para a lista de disciplinas --}}
                <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>
        </div>

        {{-- Script SweetAlert2 para confirmação ao excluir --}}
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
                            text: `Deseja realmente excluir a disciplina "${nome}"?`,
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
    </x-layouts.app>
@endsection
