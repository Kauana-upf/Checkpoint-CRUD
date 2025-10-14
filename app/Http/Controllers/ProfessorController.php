<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::all();
        return view('professores.index', compact('professores'));
    }

    public function create()
    {
        $disciplinas = Disciplina::all();
        if ($disciplinas->isEmpty()) {
            return redirect()->route('disciplinas.create')
                             ->with('error', 'Nenhuma disciplina cadastrada. Cadastre uma disciplina antes de criar um professor.');
        }
        return view('professores.create', compact('disciplinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:professores,email',
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina'
        ]);
        Professor::create($request->all());
        return redirect()->route('professores.index')
                         ->with('success', 'Professor criado com sucesso!');
    }

    public function show(Professor $professor)
    {
        return view('professores.show', compact('professor'));
    }

    public function edit(Professor $professor)
    {
        $disciplinas = Disciplina::all();
        return view('professores.edit', compact('professor', 'disciplinas'));
    }

    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:professores,email,' . $professor->id,
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina'
        ]);
        $professor->update($request->all());
        return redirect()->route('professores.index')
                         ->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professores.index')
                         ->with('success', 'Professor removido com sucesso!');
    }
}
