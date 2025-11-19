@extends('layouts.layout_principal')

@section('title', 'Professores - Boletim Escolar Online')

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            {{-- Cabeçalho da página com botão de criar novo professor --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Professores</h1>
                <a href="{{ route('professores.create') }}" class="btn btn-dark btn-custom">+ Novo Professor</a>
            </div>

            {{-- Verifica se há professores cadastrados --}}
            @if ($professores->isEmpty())
                <p>Nenhum professor cadastrado.</p>
            @else
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Disciplina</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($professores as $professor)
                            <tr>
                                <td>{{ $professor->id_professor ?? $professor->id }}</td>
                                <td>{{ $professor->nome }}</td>
                                <td>{{ $professor->email }}</td>

                                {{-- Foto --}}
                                <td>
                                    @if ($professor->foto)
                                        <img src="{{ asset('storage/' . $professor->foto) }}"
                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <span class="text-muted">Sem foto</span>
                                    @endif
                                </td>

                                {{-- Disciplina --}}
                                <td>{{ $professor->disciplina->nome ?? 'Sem disciplina' }}</td>

                                {{-- Status --}}
                                <td>
                                    <span class="badge {{ $professor->status === 'Ativo' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $professor->status }}
                                    </span>
                                </td>

                                {{-- Ações --}}
                                <td>
                                    <a href="{{ route('professores.show', $professor->id_professor ?? $professor->id) }}"
                                        class="link text-primary me-2">Ver</a>
                                    <a href="{{ route('professores.edit', $professor->id_professor ?? $professor->id) }}"
                                        class="link text-warning me-2">Editar</a>

                                    <form
                                        action="{{ route('professores.destroy', $professor->id_professor ?? $professor->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-excluir link text-danger border-0 bg-transparent p-0"
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

            <div class="mt-3 text-end">
                <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-custom">Voltar</a>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-excluir').forEach(button => {
            button.addEventListener('click', function() {
                const nome = this.getAttribute('data-nome');
                const form = this.closest('form');

                Swal.fire({
                    title: 'Excluir?',
                    text: `Deseja realmente excluir "${nome}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
