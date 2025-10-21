<x-layouts.app>

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>Detalhes do Professor</h1>

        <div class="mb-3"><strong>ID:</strong> {{ $professor->id }}</div>
        <div class="mb-3"><strong>Nome:</strong> {{ $professor->nome }}</div>
        <div class="mb-3"><strong>Email:</strong> {{ $professor->email }}</div>
        <div class="mb-3"><strong>Disciplina:</strong> {{ $professor->disciplina->nome ?? 'Sem disciplina' }}</div>

        <div class="form-actions">
            <a href="{{ route('professores.edit', $professor) }}" class="btn yellow">Editar</a>
            <a href="{{ route('professores.index') }}" class="btn gray">Voltar</a>
        </div>
    </div>
</x-layouts.app>
