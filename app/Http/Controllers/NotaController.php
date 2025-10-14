<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::all();
        return view('notas.index', compact('notas'));
    }


    public function create()
    {
        $alunos = Aluno::all();
        $disciplinas = Disciplina::all();
        return view('notas.create', compact('alunos', 'disciplinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_aluno' => 'required|exists:alunos,id_aluno',
            'id_disciplina' => 'required|exists:disciplinas,id_disciplina',
            'nota' => 'required|numeric|min:0|max:10',
        ]);

        Nota::create($request->only('id_aluno', 'id_disciplina', 'nota'));

        return redirect()->route('notas.index')->with('success', 'Nota cadastrada com sucesso!');
    }

    public function show(Nota $nota)
    {
        return view('notas.show', compact('nota'));
    }

    public function edit(Nota $nota)
    {
        $alunos = Aluno::all();
        $disciplinas = Disciplina::all();
        return view('notas.edit', compact('nota', 'alunos', 'disciplinas'));
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'id_aluno' => 'required|exists:alunos,id_aluno',
            'id_disciplina' => 'required|exists:disciplinas,id_disciplina',
            'nota' => 'required|numeric|min:0|max:10',
        ]);

        $nota->update($request->only('id_aluno', 'id_disciplina', 'nota'));

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso!');
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota excluída com sucesso!');
    }
}
