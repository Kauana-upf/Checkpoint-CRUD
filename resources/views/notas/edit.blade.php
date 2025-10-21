@extends('layouts.layout_principal')

@section('title', 'Editar Nota')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h2 class="mb-4">Editar Nota</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notas.update', $nota->id_nota) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_aluno" class="form-label">Aluno</label>
                    <select name="id_aluno" id="id_aluno" class="form-select" required>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id_aluno }}"
                                {{ $nota->id_aluno == $aluno->id_aluno ? 'selected' : '' }}>
                                {{ $aluno->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_disciplina" class="form-label">Disciplina</label>
                    <select name="id_disciplina" id="id_disciplina" class="form-select" required>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ $nota->id_disciplina == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nota" class="form-label">Nota</label>
                    <input type="number" name="nota" id="nota" step="0.01" min="0" max="10"
                        class="form-control" value="{{ old('nota', $nota->nota) }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
