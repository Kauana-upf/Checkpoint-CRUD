@extends('layouts.layout_principal')

@section('title', 'Cadastrar Professor - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Cadastrar Professor</h1>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('professores.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="nome" class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="disciplina_id" class="form-label"><strong>Disciplina</strong></label>
                    <select name="disciplina_id" id="disciplina_id" class="form-select" required>
                        <option value="">Selecione a disciplina</option>
                        @foreach ($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id_disciplina }}"
                                {{ old('disciplina_id') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                {{ $disciplina->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="ativo" class="form-label"><strong>Status</strong></label>
                    <select name="ativo" id="ativo" class="form-select" required>
                        <option value="1" {{ old('ativo') == '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('ativo') == '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="foto" class="form-label"><strong>Foto</strong></label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button>
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
