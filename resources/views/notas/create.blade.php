<x-layouts.app :title="'Cadastrar Nota'">
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h2 class="mb-4">Cadastrar Nota</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_aluno" class="form-label">Aluno</label>
                    <select name="id_aluno" id="id_aluno" class="form-select" required>
                        <option value="">Selecione o Aluno</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id_aluno }}"
                                {{ old('id_aluno') == $aluno->id_aluno ? 'selected' : '' }}>
                                {{ $aluno->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_disciplina" class="form-label">Disciplina</label>
                    <select name="id_disciplina" id="id_disciplina" class="form-select" required>
                        <option value="">Selecione a Disciplina</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('id_disciplina') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nota" class="form-label">Nota</label>
                    <input type="number" name="nota" id="nota" step="0.01" min="0" max="10"
                        class="form-control" value="{{ old('nota') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
