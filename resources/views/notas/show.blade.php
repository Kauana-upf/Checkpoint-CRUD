<x-layouts.app>

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <h1>Detalhes da Nota</h1>

        <div class="mb-3"><strong>ID:</strong> {{ $nota->id }}</div>
        <div class="mb-3"><strong>Aluno:</strong> {{ $nota->aluno->nome }}</div>
        <div class="mb-3"><strong>Disciplina:</strong> {{ $nota->disciplina->nome }}</div>
        <div class="mb-3"><strong>Nota:</strong> {{ $nota->nota }}</div>

        <div class="form-actions">
            <a href="{{ route('notas.edit', $nota) }}" class="btn yellow">Editar</a>
            <a href="{{ route('notas.index') }}" class="btn gray">Voltar</a>
        </div>
    </div>
</x-layouts.app>
