@extends('layouts.layout_principal')

@section('title', 'Cadastrar Professor - Boletim Escolar')

@section('content')
    <main class="p-6">
        <div class="card">
            <h1>Cadastrar Professor</h1>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('professores.store') }}" method="POST" class="d-flex flex-column gap-3">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="disciplina_id" class="form-label">Disciplina</label>
                    <select name="disciplina_id" id="disciplina_id" class="form-select" required>
                        <option value="">-- Selecione a disciplina --</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}">{{ $disciplina->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-column gap-2 mt-3">
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button>
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
