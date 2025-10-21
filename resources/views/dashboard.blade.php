<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3 mb-4">
            <a href="{{ route('alunos.index') }}"
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 btn-dashboard">
                Gerenciar Alunos
            </a>

            <a href="{{ route('professores.index') }}"
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 btn-dashboard">
                Gerenciar Professores
            </a>

            <a href="{{ route('disciplinas.index') }}"
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 btn-dashboard">
                Gerenciar Disciplinas
            </a>

            <a href="{{ route('notas.index') }}"
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 btn-dashboard">
                Gerenciar Notas
            </a>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>

        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>

    </div>
</x-layouts.app>
