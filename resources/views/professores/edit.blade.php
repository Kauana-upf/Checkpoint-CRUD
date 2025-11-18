@extends('layouts.layout_principal')

@section('title', isset($professor) ? 'Editar Professor - Boletim Escolar Online' : 'Cadastrar Professor - Boletim
    Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            {{-- Título da página --}}
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

            {{-- Formulário de cadastro/edição --}}
            <form
                action="{{ isset($professor) ? route('professores.update', $professor->id_professor) : route('professores.store') }}"
                method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                @if (isset($professor))
                    @method('PUT') {{-- Método PUT para edição --}}
                @endif

                {{-- Campo: Nome --}}
                <div class="form-group mb-3">
                    <label for="nome" class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $professor->nome ?? '') }}" required>
                </div>

                {{-- Campo: Email --}}
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $professor->email ?? '') }}" required>
                </div>

                {{-- Campo: Disciplina --}}
                <div class="form-group mb-3">
                    <label for="disciplina_id" class="form-label"><strong>Disciplina</strong></label>
                    <select name="disciplina_id" id="disciplina_id" class="form-select" required>
                        <option value="">Selecione a disciplina</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('disciplina_id', $professor->disciplina_id ?? '') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Campo: Status --}}
                <div class="form-group mb-3">
                    <label for="ativo" class="form-label"><strong>Status</strong></label>
                    <select name="ativo" id="ativo" class="form-select" required>
                        <option value="1" {{ old('ativo', $professor->ativo ?? '') == '1' ? 'selected' : '' }}>Ativo
                        </option>
                        <option value="0" {{ old('ativo', $professor->ativo ?? '') == '0' ? 'selected' : '' }}>Inativo
                        </option>
                    </select>
                </div>

                {{-- Campo: Foto --}}
                <div class="form-group mb-3">
                    <label for="foto" class="form-label"><strong>Foto</strong></label>
                    <input type="file" name="foto" id="foto" class="form-control">

                    @if (isset($professor) && $professor->foto)
                        {{-- Mostra foto atual caso exista --}}
                        <div class="mt-3">
                            <p class="mb-1"><strong>Foto atual:</strong></p>
                            <img src="{{ asset('storage/' . $professor->foto) }}" class="img-thumbnail"
                                style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                {{-- Botões de ação --}}
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-custom">
                        {{ isset($professor) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
