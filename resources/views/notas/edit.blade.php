@extends('layouts.layout_principal')

@section('title', 'Editar Nota')

@section('content')
    <main class="p-6">
        <div class="card">
            <h1 class="mb-4">Editar Nota</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notas.update', $nota->id_nota) }}" method="POST" class="d-flex flex-column gap-3">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label font-semibold">Aluno</label>
                    <select name="id_aluno" class="form-control" required>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id_aluno }}"
                                {{ $nota->id_aluno == $aluno->id_aluno ? 'selected' : '' }}>
                                {{ $aluno->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label font-semibold">Disciplina</label>
                    <select name="id_disciplina" class="form-control" required>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ $nota->id_disciplina == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label font-semibold">Nota</label>
                    <input type="number" name="nota" step="0.01" min="0" max="10" class="form-control"
                        value="{{ old('nota', $nota->nota) }}" required>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-warning btn-custom">Atualizar</button>
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
