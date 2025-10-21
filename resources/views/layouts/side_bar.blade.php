nav.d-flex.flex-column {
    display: flex;
    flex-direction: column;
    background-color: var(--color-zinc-50);
    border-right: 1px solid var(--color-zinc-200);
    padding: 1rem;
    width: 200px;
    min-height: 100vh;
}

nav.d-flex.flex-column a.btn-sidebar {
    display: block;
    padding: 0.75rem 1rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--color-zinc-800);
    text-decoration: none;
    border-radius: 0.5rem;
    transition: background-color 0.3s, color 0.3s;
}

nav.d-flex.flex-column a.btn-sidebar:hover,
nav.d-flex.flex-column a.btn-sidebar:focus {
    background-color: var(--color-zinc-200);
    color: var(--color-zinc-900);
    outline: none;
}

nav.d-flex.flex-column a.btn-sidebar.active {
    background-color: var(--color-zinc-900);
    color: var(--color-white);
    pointer-events: none;
}
