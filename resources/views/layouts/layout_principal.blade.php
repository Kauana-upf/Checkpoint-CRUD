<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Boletim Escolar Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    {{-- Cabeçalho fixo --}}
    @include('layouts.header')

    {{-- Conteúdo principal --}}
    <main class="container flex-grow-1 mt-4">
        @yield('content')
    </main>

    {{-- Rodapé --}}
    @include('layouts.footer')

    {{-- Scripts globais --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Confirmação de exclusão (funciona em todas as páginas) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-excluir').forEach(button => {
                button.addEventListener('click', function() {
                    const nome = this.dataset.nome;
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
        });
    </script>

    {{-- Espaço para scripts extras de cada página --}}
    @stack('scripts')

</body>

</html>
