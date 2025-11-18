@extends('layouts.layout_principal') {{-- Usa o layout principal --}}

@section('title', 'Cadastrar Nota - Boletim Escolar Online') {{-- Define o título da aba --}}

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Cadastrar Nota</h1>

            @if ($errors->any()) {{-- Exibe erros de validação --}}
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notas.store') }}" method="POST"> {{-- Formulário para criar nota --}}
                @csrf

                <div class="form-group mb-3"> {{-- Campo: Aluno --}}
                    <label for="id_aluno" class="form-label"><strong>Aluno</strong></label>
                    <select name="id_aluno" id="id_aluno" class="form-select" required>
                        <option value="">Selecione o aluno</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id_aluno }}"
                                {{ old('id_aluno') == $aluno->id_aluno ? 'selected' : '' }}>
                                {{ $aluno->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_aluno')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3"> {{-- Campo: Disciplina --}}
                    <label for="id_disciplina" class="form-label"><strong>Disciplina</strong></label>
                    <select name="id_disciplina" id="id_disciplina" class="form-select" required>
                        <option value="">Selecione a disciplina</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('id_disciplina') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_disciplina')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4"> {{-- Campo: Nota --}}
                    <label for="nota" class="form-label"><strong>Nota</strong></label>
                    <input type="number" name="nota" id="nota" step="0.01" min="0" max="10"
                        class="form-control" value="{{ old('nota') }}" placeholder="Ex: 8.5" required>
                    @error('nota')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between"> {{-- Botões de ação --}}
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button> {{-- Envia formulário --}}
                    <a href="{{ route('notas.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                    {{-- Volta à lista --}}
                </div>
            </form>
        </div>
    </main>
@endsection
