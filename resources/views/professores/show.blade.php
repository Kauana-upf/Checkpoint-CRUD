@extends('layouts.layout_principal')

@section('title', 'Detalhes do Professor - Boletim Escolar')

@section('content')
    <main class="p-6">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detalhes do Professor</h1>
                <a href="{{ route('professores.index') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>

            <div class="mb-3"><span class="fw-bold">ID:</span> {{ $professor->id }}</div>
            <div class="mb-3"><span class="fw-bold">Nome:</span> {{ $professor->nome }}</div>
            <div class="mb-3"><span class="fw-bold">Email:</span> {{ $professor->email }}</div>
            <div class="mb-3"><span class="fw-bold">Disciplina:</span>
                {{ $professor->disciplina->nome ?? 'Sem disciplina' }}</div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('professores.edit', $professor) }}" class="btn btn-warning btn-custom">Editar</a>
                <form action="{{ route('professores.destroy', $professor) }}" method="POST"
                    onsubmit="return confirm('Deseja realmente excluir?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-custom">Excluir</button>
                </form>
            </div>
        </div>
    </main>
@endsection
