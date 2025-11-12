@extends('layouts.layout_principal')

@section('title', isset($professor) ? 'Editar Professor - Boletim Escolar Online' : 'Cadastrar Professor - Boletim
    Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h1>{{ isset($professor) ? 'Editar Professor' : 'Cadastrar Professor' }}</h1>

            {{-- Exibe mensagens de erro de validação --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulário para criar ou atualizar um professor --}}
            <form action="{{ isset($professor) ? route('professores.update', $professor->id) : route('professores.store') }}"
                method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                @if (isset($professor))
                    @method('PUT')
                @endif

                {{-- Campo: Nome --}}
                <div class="form-group mb-3">
                    <label for="nome" class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $professor->nome ?? '') }}" placeholder="Ex: João da Silva" required>
                    @error('nome')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo: Email --}}
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $professor->email ?? '') }}" placeholder="exemplo@email.com" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo: Disciplina --}}
                <div class="form-group mb-3">
                    <label for="disciplina_id" class="form-label"><strong>Disciplina</strong></label>
                    <select name="disciplina_id" id="disciplina_id" class="form-select" required>
                        <option value="">Selecione a disciplina</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('disciplina_id', $professor->disciplina_id ?? ($professor->disciplina->id_disciplina ?? '')) == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('disciplina_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo: Foto --}}
                <div class="form-group mb-3">
                    <label for="foto" class="form-label"><strong>Foto</strong></label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">

                    {{-- Exibe a imagem atual se existir --}}
                    @if (isset($professor) && $professor->foto)
                        <div class="mt-3">
                            <p class="mb-1"><strong>Foto atual:</strong></p>
                            <img src="{{ asset('storage/' . $professor->foto) }}" alt="Foto do Professor"
                                class="img-thumbnail" style="max-width: 150px; height: auto;">
                        </div>
                    @endif

                    @error('foto')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
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
