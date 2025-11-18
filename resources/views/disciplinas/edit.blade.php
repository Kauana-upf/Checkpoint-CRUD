@extends('layouts.layout_principal')

@section('title', 'Editar Disciplina')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h2 class="mb-4 text-center">Editar Disciplina</h2>

            // Exibe mensagens de erro de validação, se houver
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            // Formulário para editar disciplina
            // action chama a rota 'disciplinas.update' que executa o método update do controller
            // method="POST" com @method('PUT') usado pois estamos atualizando um registro existente
            <form action="{{ route('disciplinas.update', $disciplina->id_disciplina) }}" method="POST">
                @csrf
                @method('PUT')

                // Campo para o nome da disciplina
                <div class="form-group mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome', $disciplina->nome) }}"
                        class="form-control" required>
                    @error('nome')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                // Campo para a carga horária da disciplina
                <div class="form-group mb-3">
                    <label for="carga_horaria" class="form-label fw-semibold">Carga Horária</label>
                    <input type="number" name="carga_horaria" id="carga_horaria"
                        value="{{ old('carga_horaria', $disciplina->carga_horaria) }}" class="form-control" required>
                    @error('carga_horaria')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                // Campo opcional de descrição
                <div class="form-group mb-3">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="4" class="form-control">{{ old('descricao', $disciplina->descricao) }}</textarea>
                </div>

                // Botões: Atualizar envia PUT para update, Cancelar volta para show
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="submit" class="btn btn-dark btn-custom">Atualizar</button>
                    <a href="{{ route('disciplinas.show', $disciplina->id_disciplina) }}"
                        class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>

            // Link extra para voltar ao dashboard
            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </div>
@endsection
