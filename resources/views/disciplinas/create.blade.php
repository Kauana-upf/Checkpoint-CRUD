@extends('layouts.layout_principal')

@section('title', 'Nova Disciplina')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h2 class="mb-4 text-center">Nova Disciplina</h2>

            {{-- Formulário para cadastrar uma nova disciplina --}}
            {{-- action chama a rota 'disciplinas.store' que executa o método store do controller --}}
            {{-- method="POST" é usado porque envia dados para criar um novo registro --}}
            <form action="{{ route('disciplinas.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="carga_horaria" class="form-label fw-semibold">Carga Horária</label>
                    <input type="number" name="carga_horaria" id="carga_horaria" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control"></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button>
                    <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
