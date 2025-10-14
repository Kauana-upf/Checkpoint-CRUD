@extends('layouts.layout_principal')

@section('title', 'Boletim Escolar - Dashboard')

@section('content')
    <main class="p-6">
        <div class="card text-center">
            <h1>Boletim Escolar Online</h1>
            <h3>Gestão de alunos, notas e histórico acadêmico</h3>
            <p>Este sistema permite gerenciar alunos, cadastrar notas, visualizar boletins e acompanhar o desempenho escolar
                de forma segura e eficiente.</p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('alunos.index') }}" class="btn btn-dark btn-custom">Gerenciar Alunos</a>
                <a href="{{ route('boletim.index') }}" class="btn btn-secondary btn-custom">Visualizar Boletins</a>
            </div>
        </div>
    </main>
@endsection
