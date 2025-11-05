@extends('layouts.layout_principal')

@section('title', 'Detalhes da Nota - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Detalhes da Nota</h1>

            {{-- Exibe informações da nota --}}
            <div class="form-group mb-2">
                <label><strong>ID:</strong></label>
                <p>{{ $nota->id_nota }}</p>
            </div>

            <div class="form-group mb-2">
                <label><strong>Aluno:</strong></label>
                <p>{{ $nota->aluno->nome }}</p>
            </div>

            <div class="form-group mb-2">
                <label><strong>Disciplina:</strong></label>
                <p>{{ $nota->disciplina->nome }}</p>
            </div>

            <div class="form-group mb-4">
                <label><strong>Nota:</strong></label>
                <p>{{ $nota->nota }}</p>
            </div>

            {{-- Botões --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('notas.edit', $nota->id_nota) }}" class="btn btn-dark btn-custom">Editar</a>
                <a href="{{ route('notas.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
            </div>
        </div>
    </main>
@endsection
