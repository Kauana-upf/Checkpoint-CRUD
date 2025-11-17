@extends('layouts.layout_principal')

@section('title', 'Cadastrar Aluno - Boletim Escolar Online')

@section('content')
    <main>
        <div class="card p-4">
            <h1 class="mb-4">Cadastrar Aluno</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('alunos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>

                <div class="form-group mb-3">
                    <label for="ativo" class="form-label">Status</label>
                    <select name="ativo" id="ativo" class="form-control">
                        <option value="1" selected>Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary btn-custom">Voltar</a>
                    <button type="submit" class="btn btn-dark btn-custom">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
