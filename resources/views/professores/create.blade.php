@extends('layouts.layout_principal')

@section('title', 'Cadastrar Professor - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Cadastrar Professor</h1>

            {{-- Exibe mensagens de erro ou falhas --}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Exibe erros de validação do formulário --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulário de cadastro de professor --}}
            {{-- action chama a rota professores.store, que executa o método store no controller --}}
            {{-- method="POST" é usado pois estamos enviando dados para criar um novo registro --}}
            <form action="{{ route('professores.store') }}" method="POST">
                @csrf

                {{-- Campo: Nome --}}
                <div class="form-group mb-3">
                    <label for="nome" class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}"
                        placeholder="Ex: João da Silva" required>
                    @error('nome')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo: Email --}}
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        placeholder="exemplo@email.com" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo: Disciplina --}}
                <div class="form-group mb-4">
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
                    @error('disciplina_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botões de ação --}}
                <div class="d-flex justify-content-between">
                    {{-- Envia o formulário (POST) --}}
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button>

                    {{-- Volta para a lista de professores --}}
                    <a href="{{ route('professores.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                </div>
            </form>
        </div>
    </main>
@endsection
