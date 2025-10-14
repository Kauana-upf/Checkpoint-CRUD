<x-layouts.app :title="__('Editar Disciplina')" :dark-mode="auth()->user()->pref_dark_mode">

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>Editar Disciplina</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('disciplinas.update', $disciplina->id_disciplina) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $disciplina->nome) }}" required>
                @error('nome')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="carga_horaria">Carga Horária</label>
                <input type="number" name="carga_horaria" id="carga_horaria"
                    value="{{ old('carga_horaria', $disciplina->carga_horaria) }}" required>
                @error('carga_horaria')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4">{{ old('descricao', $disciplina->descricao) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit">Atualizar</button>
                <a href="{{ route('disciplinas.show', $disciplina->id_disciplina) }}" class="btn gray">Cancelar</a>
            </div>
        </form>

        <div class="mt-3 text-end">
            <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
        </div>
    </div>
</x-layouts.app>
