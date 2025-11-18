<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    // Lista todos os professores (obrigatório: index com listagem)
    public function index()
    {
        // GET usado pois apenas visualizamos registros
        $professores = Professor::with('disciplina')->get(); // retorna todos professores com disciplina
        return view('professores.index', compact('professores'));
    }

    // Formulário para criar um novo professor
    public function create()
    {
        // GET usado pois apenas retorna formulário
        $disciplinas = Disciplina::all(); // necessário para selecionar disciplina
        return view('professores.create', compact('disciplinas'));
    }

    // Salva um novo professor
    public function store(Request $request)
    {
        // POST usado pois criamos um novo recurso (professor)
        $request->validate([
            'nome' => 'required|string|max:255', // obrigatório
            'email' => 'required|email', // obrigatório
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina', // obrigatório e FK
            'ativo' => 'required|boolean', // obrigatório, permite ativar/inativar
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // facultativo
        ]);

        $dados = $request->all();

        // Upload de foto se houver
        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Professor::create($dados); // cria professor
        return redirect()->route('professores.index')->with('success', 'Professor cadastrado com sucesso!');
    }

    // Mostra detalhes de um professor
    public function show(Professor $professor)
    {
        // GET usado pois apenas visualizamos dados
        return view('professores.show', compact('professor'));
    }

    // Formulário para editar um professor existente
    public function edit(Professor $professor)
    {
        // GET usado pois retorna formulário preenchido
        $disciplinas = Disciplina::all(); // necessário para alterar disciplina
        return view('professores.edit', compact('professor', 'disciplinas'));
    }

    // Atualiza dados de um professor
    public function update(Request $request, Professor $professor)
    {
        // PUT/PATCH usado pois alteramos um recurso existente
        $request->validate([
            'nome' => 'required|string|max:255', // obrigatório
            'email' => 'required|email', // obrigatório
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina', // obrigatório e FK
            'ativo' => 'required|boolean', // obrigatório, permite ativar/inativar
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // facultativo
        ]);

        $dados = $request->all();

        // Upload de nova foto se houver, excluindo a antiga
        if ($request->hasFile('foto')) {
            if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
                Storage::disk('public')->delete($professor->foto);
            }
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $professor->update($dados); // atualiza professor
        return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
    }

    // Remove um professor do banco
    public function destroy(Professor $professor)
    {
        // DELETE usado pois excluímos um recurso (professor)
        // Remove foto se existir
        if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
            Storage::disk('public')->delete($professor->foto);
        }

        $professor->delete(); // exclui professor
        return redirect()->route('professores.index')->with('success', 'Professor excluído com sucesso!');
    }
}
