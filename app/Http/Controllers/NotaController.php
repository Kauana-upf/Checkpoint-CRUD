<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    // Lista todas as notas (com paginação)
    public function index()
    {
        // GET usado pois apenas visualizamos os registros
        $notas = Nota::paginate(10); // 10 registros por página
        return view('notas.index', compact('notas'));
    }

    // Formulário para criar nova nota
    public function create()
    {
        // GET usado pois retorna formulário vazio
        $alunos = Aluno::all(); // necessário para selecionar aluno
        $disciplinas = Disciplina::all(); // necessário para selecionar disciplina
        return view('notas.create', compact('alunos', 'disciplinas'));
    }

    // Salva uma nova nota no banco
    public function store(Request $request)
    {
        // POST usado pois criamos um novo recurso (nota)
        $request->validate([
            'id_aluno' => 'required|exists:alunos,id_aluno', // obrigatório e FK
            'id_disciplina' => 'required|exists:disciplinas,id_disciplina', // obrigatório e FK
            'nota' => 'required|numeric|min:0|max:10', // obrigatório
        ]);

        Nota::create($request->only('id_aluno', 'id_disciplina', 'nota')); // cria nota

        return redirect()->route('notas.index')->with('success', 'Nota cadastrada com sucesso!');
    }

    // Mostra detalhes de uma nota
    public function show(Nota $nota)
    {
        // GET usado pois apenas visualizamos dados
        return view('notas.show', compact('nota'));
    }

    // Formulário para editar nota existente
    public function edit(Nota $nota)
    {
        // GET usado pois retorna formulário preenchido
        $alunos = Aluno::all(); // necessário para alterar aluno
        $disciplinas = Disciplina::all(); // necessário para alterar disciplina
        return view('notas.edit', compact('nota', 'alunos', 'disciplinas'));
    }

    // Atualiza dados de uma nota
    public function update(Request $request, Nota $nota)
    {
        // PUT/PATCH usado pois alteramos um recurso existente
        $request->validate([
            'id_aluno' => 'required|exists:alunos,id_aluno', // obrigatório e FK
            'id_disciplina' => 'required|exists:disciplinas,id_disciplina', // obrigatório e FK
            'nota' => 'required|numeric|min:0|max:10', // obrigatório
        ]);

        $nota->update($request->only('id_aluno', 'id_disciplina', 'nota')); // atualiza nota

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso!');
    }

    // Remove uma nota do banco
    public function destroy(Nota $nota)
    {
        // DELETE usado pois excluímos um recurso (nota)
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota excluída com sucesso!');
    }
}
