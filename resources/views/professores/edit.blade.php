@extends('layouts.layout_principal')

@section('title', isset($professor) ? 'Editar Professor - Boletim Escolar Online' : 'Cadastrar Professor - Boletim
    Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">

            <h1>{{ isset($professor) ? 'Editar Professor' : 'Cadastrar Professor' }}</h1>

            {{-- Exibe erros de validação --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulário --}}
            <form action="{{ isset($professor) ? route('professores.update', $professor) : route('professores.store') }}"
                method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3 mt-4">

                @csrf
                @if (isset($professor))
                    @method('PUT')
                @endif

                {{-- Nome --}}
                <div class="form-group">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $professor->nome ?? '') }}" required>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $professor->email ?? '') }}" required>
                </div>

                {{-- Disciplina --}}
                <div class="form-group">
                    <label for="disciplina_id" class="form-label">Disciplina</label>
                    <select name="disciplina_id" id="disciplina_id" class="form-control" required>
                        <option value="">Selecione uma disciplina</option>

                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('disciplina_id', $professor->disciplina_id ?? '') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Ativo" {{ old('status', $professor->status ?? '') == 'Ativo' ? 'selected' : '' }}>
                            Ativo</option>
                        <option value="Inativo"
                            {{ old('status', $professor->status ?? '') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                {{-- Foto --}}
                <div class="form-group">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">

                    @if (isset($professor) && $professor->foto)
                        <img src="{{ asset('storage/' . $professor->foto) }}" class="mt-3 img-thumbnail"
                            style="max-width: 150px;">
                    @endif
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                    <button type="submit" class="btn btn-warning btn-custom">
                        {{ isset($professor) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
