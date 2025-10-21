<x-layouts.app :title="isset($professor) ? __('Editar Professor') : __('Cadastrar Professor')">

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>{{ isset($professor) ? 'Editar Professor' : 'Cadastrar Professor' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($professor) ? route('professores.update', $professor->id) : route('professores.store') }}"
            method="POST">
            @csrf
            @if (isset($professor))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $professor->nome ?? '') }}"
                    required>
                @error('nome')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $professor->email ?? '') }}"
                    required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="disciplina_id">Disciplina</label>
                <select name="disciplina_id" id="disciplina_id" required>
                    <option value="">Selecione a disciplina</option>
                    @foreach ($disciplinas as $disciplina)
                        <option value="{{ $disciplina->id_disciplina }}"
                            {{ old('disciplina_id', $professor->disciplina_id ?? ($professor->disciplina->id_disciplina ?? '')) == $disciplina->id_disciplina ? 'selected' : '' }}>
                            {{ $disciplina->nome }}
                        </option>
                    @endforeach
                </select>
                @error('disciplina_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit">{{ isset($professor) ? 'Atualizar' : 'Cadastrar' }}</button>
                <a href="{{ route('professores.index') }}" class="btn gray">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>
