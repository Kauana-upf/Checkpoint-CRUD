<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }
    

    // Formulário para criar novo aluno
    public function create()
    {
        return view('alunos.create');
    }

    // Salvar novo aluno
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email'
        ]);

        Aluno::create($request->only(['nome', 'data_nascimento', 'email']));

        return redirect()->route('alunos.index')->with('success', 'Aluno criado com sucesso!');
    }

    // Exibir um aluno específico
    public function show(Aluno $aluno)
    {
        return view('alunos.show', compact('aluno'));
    }

    // Formulário para editar aluno
    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    // Atualizar aluno
    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email'
        ]);

        $aluno->update($request->only(['nome', 'data_nascimento', 'email']));

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Deletar aluno
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso!');
    }
}
