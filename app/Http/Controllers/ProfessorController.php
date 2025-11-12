<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::with('disciplina')->get();
        return view('professores.index', compact('professores'));
    }

    public function create()
    {
        $disciplinas = Disciplina::all();
        return view('professores.create', compact('disciplinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina',
            'status' => 'required|in:Ativo,Inativo',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Professor::create($dados);
        return redirect()->route('professores.index')->with('success', 'Professor cadastrado com sucesso!');
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
            'email' => 'required|email',
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina',
            'status' => 'required|in:Ativo,Inativo',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('foto')) {
            if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
                Storage::disk('public')->delete($professor->foto);
            }
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $professor->update($dados);
        return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy(Professor $professor)
    {
        if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
            Storage::disk('public')->delete($professor->foto);
        }

        $professor->delete();
        return redirect()->route('professores.index')->with('success', 'Professor excluído com sucesso!');
    }
}
