<x-layouts.app>

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>Novo Professor</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('professores.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                    placeholder="Ex: João da Silva" required>
                @error('nome')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="exemplo@email.com" required>
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
                            {{ old('disciplina_id') == $disciplina->id_disciplina ? 'selected' : '' }}>
                            {{ $disciplina->nome }}
                        </option>
                    @endforeach
                </select>
                @error('disciplina_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit">Salvar</button>
                <a href="{{ route('professores.index') }}" class="btn gray">Voltar</a>
            </div>
        </form>
    </div>
</x-layouts.app>
