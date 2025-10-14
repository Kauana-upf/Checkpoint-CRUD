@extends('layouts.app')

@section('content')
<main class="p-6">
    <div class="card p-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Detalhes da Nota</h1>
            <a href="{{ route('notas.index') }}" class="btn btn-dark btn-custom">Voltar</a>
        </div>

        <div class="mb-3"><strong>ID:</strong> {{ $nota->id }}</div>
        <div class="mb-3"><strong>Aluno:</strong> {{ $nota->aluno->nome }}</div>
        <div class="mb-3"><strong>Disciplina:</strong> {{ $nota->disciplina->nome }}</div>
        <div class="mb-3"><strong>Nota:</strong> {{ $nota->nota }}</div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('notas.edit', $nota) }}" class="btn btn-warning btn-custom">Editar</a>
            <form action="{{ route('notas.destroy', $nota) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-custom">Excluir</button>
            </form>
        </div>
    </div>
</main>
@endsection
