@extends('layouts.layout_principal')

@section('title', 'Editar Nota - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Editar Nota</h1>

            // Exibe erros de validação
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            // Formulário de edição
            <form action="{{ route('notas.update', $nota->id_nota) }}" method="POST">
                @csrf
                @method('PUT')

                // Campo: Aluno
                <div class="form-group mb-3">
                    <label for="id_aluno" class="form-label"><strong>Aluno</strong></label>
                    <select name="id_aluno" id="id_aluno" class="form-select" required>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id_aluno }}"
                                {{ $nota->id_aluno == $aluno->id_aluno ? 'selected' : '' }}>
                                {{ $aluno->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                // Campo: Disciplina
                <div class="form-group mb-3">
                    <label for="id_disciplina" class="form-label"><strong>Disciplina</strong></label>
                    <select name="id_disciplina" id="id_disciplina" class="form-select" required>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ $nota->id_disciplina == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                // Campo: Nota
                <div class="form-group mb-4">
                    <label for="nota" class="form-label"><strong>Nota</strong></label>
                    <input type="number" name="nota" id="nota" step="0.01" min="0" max="10"
                        class="form-control" value="{{ old('nota', $nota->nota) }}" required>
                </div>

                // Botões
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark btn-custom">Atualizar</button>
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
