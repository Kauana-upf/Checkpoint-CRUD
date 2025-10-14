<x-layouts.app :title="'Nova Disciplina'">
    <main class="flex flex-1 items-center justify-center p-8">
        <div class="card max-w-md w-full p-8">
            <h1 class="mb-4 font-semibold text-gray-900 text-2xl text-center">Nova Disciplina</h1>
            <form action="{{ route('disciplinas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="form-label font-semibold">Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div>
                    <label class="form-label font-semibold">Carga Horária</label>
                    <input type="number" name="carga_horaria" class="form-control" required>
                </div>
                <div>
                    <label class="form-label font-semibold">Descrição</label>
                    <textarea name="descricao" class="form-control"></textarea>
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="submit" class="btn btn-dark btn-custom">Salvar</button>
                    <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary btn-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</x-layouts.app>
