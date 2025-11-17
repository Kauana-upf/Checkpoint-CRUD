@extends('layouts.layout_principal')

@section('title', 'Editar Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Editar Aluno</h1>

            {{-- Exibe mensagens de erro originadas da validação do formulário --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulário de edição do aluno --}}
            <form action="{{ route('alunos.update', $aluno) }}" method="POST" class="d-flex flex-column gap-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $aluno->nome) }}" required>
                </div>

                <div class="form-group">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento', $aluno->data_nascimento) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $aluno->email ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    @if ($aluno->foto)
                        <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do Aluno" class="mt-2"
                            style="max-width:150px;">
                    @endif
                </div>

                <div class="form-group">
                    <label for="ativo" class="form-label">Status</label>
                    <select name="ativo" id="ativo" class="form-control">
                        <option value="1" {{ old('ativo', $aluno->ativo) || $aluno->ativo ? 'selected' : '' }}>Ativo
                        </option>
                        <option value="0" {{ !(old('ativo', $aluno->ativo) || $aluno->ativo) ? 'selected' : '' }}>
                            Inativo</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                    <button type="submit" class="btn btn-warning btn-custom">Atualizar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
