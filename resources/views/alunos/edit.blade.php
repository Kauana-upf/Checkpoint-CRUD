@extends('layouts.layout_principal')

@section('title', 'Editar Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Editar Aluno</h1>

            {{-- Exibe mensagens de erro da validação --}}
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
                @method('PUT') {{-- Indica atualização de recurso --}}

                {{-- Campo obrigatório: nome --}}
                <div class="form-group">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome', $aluno->nome) }}" required>
                </div>

                {{-- Campo obrigatório: data de nascimento --}}
                <div class="form-group">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento', $aluno->data_nascimento) }}" required>
                </div>

                {{-- Campo obrigatório: email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $aluno->email ?? '') }}" required>
                </div>

                {{-- Campo facultativo: upload de foto --}}
                <div class="form-group">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">

                    @if ($aluno->foto)
                        <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do Aluno" class="mt-2"
                            style="max-width:150px;">
                    @endif
                </div>

                {{-- Campo: status (Ativo / Inativo) --}}
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Ativo" {{ old('status', $aluno->status) == 'Ativo' ? 'selected' : '' }}>
                            Ativo
                        </option>
                        <option value="Inativo" {{ old('status', $aluno->status) == 'Inativo' ? 'selected' : '' }}>
                            Inativo
                        </option>
                    </select>
                </div>

                {{-- Botões --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                    <button type="submit" class="btn btn-warning btn-custom">Atualizar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
