<x-layouts.app :title="'Cadastrar Nota'">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-6">
        <div class="card p-4">
            <h1>Cadastrar Nota</h1>

            @if ($errors->any())
                <div class="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notas.store') }}" method="POST" class="d-flex flex-col gap-3">
                @csrf

                <select name="id_aluno" class="form-control" required>
                    <option value="">Selecione o Aluno</option>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id_aluno }}" {{ old('id_aluno') == $aluno->id_aluno ? 'selected' : '' }}>
                            {{ $aluno->nome }}
                        </option>
                    @endforeach
                </select>

                <select name="id_disciplina" class="form-control" required>
                    <option value="">Selecione a Disciplina</option>
                    @foreach($disciplinas as $disciplina)
                        <option value="{{ $disciplina->id_disciplina }}" {{ old('id_disciplina') == $disciplina->id_disciplina ? 'selected' : '' }}>
                            {{ $disciplina->nome }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="nota" step="0.01" min="0" max="10" placeholder="Nota" class="form-control" value="{{ old('nota') }}" required>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
