<x-layouts.app :title="'Boletim Escolar Online'">
    <main class="flex flex-1 items-center justify-center p-8">
        <div class="card text-center max-w-xl p-10">
            <h1 class="mb-4 font-semibold text-gray-900 text-3xl">Boletim Escolar Online</h1>
            <p class="lead text-gray-600 mb-6">
                Sistema acadêmico desenvolvido para cadastro de alunos, registro de disciplinas,
                lançamento de notas e geração automática de boletins escolares.
            </p>

            <div class="flex justify-center gap-3 mt-4">
                <a href="{{ route('login') }}" class="btn btn-dark btn-custom">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-custom">Cadastro</a>
            </div>
        </div>
    </main>
</x-layouts.app>
