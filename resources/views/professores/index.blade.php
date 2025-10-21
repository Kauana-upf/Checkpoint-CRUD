<x-layouts.app :title="__('Professores')">

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h1>Professores</h1>
            <a href="{{ route('professores.create') }}" class="btn">+ Novo Professor</a>
        </div>

        @if ($professores->isEmpty())
            <p>Nenhum professor cadastrado.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professores as $professor)
                        <tr>
                            <td>{{ $professor->id }}</td>
                            <td>{{ $professor->nome }}</td>
                            <td>{{ $professor->email }}</td>
                            <td title="{{ $professor->disciplina->nome ?? 'Sem disciplina' }}">
                                {{ Str::limit($professor->disciplina->nome ?? 'Sem disciplina', 80) }}
                            </td>
                            <td>
                                <a href="{{ route('professores.show', $professor) }}" class="link blue">Ver</a>
                                <a href="{{ route('professores.edit', $professor) }}" class="link yellow">Editar</a>
                                <form action="{{ route('professores.destroy', $professor) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-excluir link red"
                                        data-nome="{{ $professor->nome }}">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-3">
            <a href="{{ url('/dashboard') }}" class="btn gray">Voltar</a>
        </div>
    </div>
</x-layouts.app>
