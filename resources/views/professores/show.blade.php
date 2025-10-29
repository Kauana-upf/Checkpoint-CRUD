@extends('layouts.layout_principal')
@include('layouts.header')

<x-layouts.app>
    <div class="container">
        <h1>Detalhes do Professor</h1>

        <div class="form-group">
            <label><strong>ID:</strong></label>
            <p>{{ $professor->id }}</p>
        </div>

        <div class="form-group">
            <label><strong>Nome:</strong></label>
            <p>{{ $professor->nome }}</p>
        </div>

        <div class="form-group">
            <label><strong>Email:</strong></label>
            <p>{{ $professor->email }}</p>
        </div>

        <div class="form-group">
            <label><strong>Disciplina:</strong></label>
            <p>{{ $professor->disciplina->nome ?? 'Sem disciplina' }}</p>
        </div>

        <div class="form-actions flex gap-2 mt-4">
            <a href="{{ route('professores.edit', $professor) }}" class="btn-dashboard">Editar</a>

            <form action="{{ route('professores.destroy', $professor) }}" method="POST"
                onsubmit="return confirm('Deseja realmente excluir este professor?');">
                @csrf
                @method('DELETE')
                <button class="btn-dashboard" style="background-color: #dc2626; border-color: #b91c1c;">Excluir</button>
            </form>

            <a href="{{ route('professores.index') }}" class="btn-dashboard"
                style="background-color: #737373;">Voltar</a>
        </div>
    </div>
</x-layouts.app>
