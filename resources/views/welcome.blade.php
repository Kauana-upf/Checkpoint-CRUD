<x-layouts.app :title="'Boletim Escolar Online'">
    <div class="flex h-full w-full flex-1 items-center justify-center p-8">
        <div class="card text-center max-w-xl p-10 rounded-xl">
            <h1 class="mb-4 font-semibold text-gray-900 text-3xl">Boletim Escolar Online</h1>
            <p class="lead text-gray-600 mb-6">
                Sistema acadêmico desenvolvido para cadastro de alunos, registro de disciplinas,
                lançamento de notas e geração automática de boletins escolares.
            </p>

            <div class="flex justify-center gap-3 mt-4">
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn gray">Cadastro</a>
            </div>
        </div>
    </div>
</x-layouts.app>
