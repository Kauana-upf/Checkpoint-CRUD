<nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: #111827;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Boletim Escolar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('disciplinas.index') }}" class="nav-link">Disciplinas</a></li>
                <li class="nav-item"><a href="{{ route('professores.index') }}" class="nav-link">Professores</a></li>
                <li class="nav-item"><a href="{{ route('notas.index') }}" class="nav-link">Notas</a></li>
            </ul>
        </div>
    </div>
</nav>
