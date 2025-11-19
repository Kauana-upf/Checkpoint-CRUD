<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    // Lista professores paginados
    public function index()
    {
        $professores = Professor::paginate(5);
        return view('professores.index', compact('professores'));
    }

    // Formulário de criação
    public function create()
    {
        $disciplinas = Disciplina::all();
        return view('professores.create', compact('disciplinas'));
    }

    // Salva um novo professor
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina',
            'status' => 'required|in:Ativo,Inativo',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Professor::create($data);

        return redirect()->route('professores.index')->with('success', 'Professor criado com sucesso!');
    }

    // Mostra detalhes de um professor
    public function show($id)
    {
        $professor = Professor::findOrFail($id);
        return view('professores.show', compact('professor'));
    }

    // Formulário de edição
    public function edit($id)
    {
        $professor = Professor::findOrFail($id);
        $disciplinas = Disciplina::all();
        return view('professores.edit', compact('professor', 'disciplinas'));
    }

    // Atualiza um professor
    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina',
            'status' => 'required|in:Ativo,Inativo',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($professor->foto) Storage::disk('public')->delete($professor->foto);
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $professor->update($data);

        return redirect()->route('professores.show', $professor)->with('success', 'Professor atualizado com sucesso!');
    }

    // Remove um professor
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        if ($professor->foto) Storage::disk('public')->delete($professor->foto);
        $professor->delete();

        return redirect()->route('professores.index')->with('success', 'Professor removido com sucesso!');
    }
}
