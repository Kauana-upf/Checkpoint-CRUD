@extends('layouts.layout_principal')

@section('title', isset($professor) ? 'Editar Professor' : 'Cadastrar Professor')

@section('content')
    <main class="p-6">
        <div class="card">
            <h1 class="mb-4">{{ isset($professor) ? 'Editar Professor' : 'Cadastrar Professor' }}</h1>

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
                method="POST" class="d-flex flex-column gap-3">
                @csrf
                @if (isset($professor))
                    @method('PUT')
                @endif

                <input type="text" name="nome" placeholder="Nome" class="form-control"
                    value="{{ old('nome', $professor->nome ?? '') }}" required>

                <input type="email" name="email" placeholder="Email" class="form-control"
                    value="{{ old('email', $professor->email ?? '') }}" required>

                <select name="disciplina_id" class="form-control" required>
                    <option value="">Selecione a disciplina</option>
                    @foreach ($disciplinas as $disciplina)
                        <option value="{{ $disciplina->id_disciplina }}" @selected(old('disciplina_id', $professor->disciplina_id ?? ($professor->disciplina->id_disciplina ?? '')) == $disciplina->id_disciplina)>
                            {{ $disciplina->nome }}
                        </option>
                    @endforeach
                </select>

                <div class="d-flex flex-column gap-2 mt-3">
                    <button type="submit"
                        class="btn btn-dark btn-custom">{{ isset($professor) ? 'Atualizar' : 'Cadastrar' }}</button>
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
