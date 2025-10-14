<x-layouts.app :title="__('Disciplinas')">

    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h1 class="m-0">Disciplinas</h1>
            <a href="{{ route('disciplinas.create') }}" class="btn btn-dark btn-custom">Nova Disciplina</a>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Carga Horária</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $disciplina)
                        <tr>
                            <td>{{ $disciplina->id }}</td>
                            <td>{{ $disciplina->nome }}</td>
                            <td>{{ $disciplina->carga_horaria }}</td>
                            <td title="{{ $disciplina->descricao }}">
                                {{ Str::limit($disciplina->descricao, 80) }}
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('disciplinas.show', $disciplina) }}"
                                    class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('disciplinas.edit', $disciplina) }}"
                                    class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('disciplinas.destroy', $disciplina) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-excluir"
                                        data-nome="{{ $disciplina->nome }}">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-end">
            <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
        </div>
    </div>
</x-layouts.app>
