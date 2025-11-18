<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{
    // Lista alunos paginados (obrigatório: paginação no index)
    // GET usado porque apenas recuperamos e exibimos dados
    public function index()
    {
        $alunos = Aluno::paginate(5); 
        return view('alunos.index', compact('alunos'));
    }

    // Form. para criar um novo aluno
    // GET usado porque apenas exibimos a tela
    public function create()
    {
        return view('alunos.create');
    }

    // Salva um novo aluno no banco
    // POST usado porque criamos um novo recurso
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'status' => 'nullable|in:Ativo,Inativo', // opcional para enum
            'ativo' => 'nullable|in:0,1', // opcional para bool
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // upload de imagem
        ]);

        if (isset($data['status'])) {
            $data['ativo'] = $data['status'] === 'Ativo' ? 1 : 0;
            unset($data['status']);
        } elseif (isset($data['ativo'])) {
            $data['ativo'] = (int) $data['ativo'];
        } else {
            $data['ativo'] = 1; 
        }

        // Upload de foto se existir
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Aluno::create($data); 
        return redirect()->route('alunos.index')->with('success', 'Aluno criado com sucesso!');
    }

    // Mostra detalhes de um aluno
    // GET usado pois apenas visualizamos informações
    public function show($id)
    {
        $aluno = Aluno::findOrFail($id); 
        return view('alunos.show', compact('aluno'));
    }

    // Form. para editar um aluno existente
    // GET usado porque apenas exibimos dados para edição
    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    // Atualiza dados de um aluno existente
    // PUT/PATCH usado porque alteramos um recurso
    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'status' => 'nullable|in:Ativo,Inativo',
            'ativo' => 'nullable|in:0,1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (isset($data['status'])) {
            $data['ativo'] = $data['status'] === 'Ativo' ? 1 : 0;
            unset($data['status']);
        } elseif (isset($data['ativo'])) {
            $data['ativo'] = (int) $data['ativo'];
        }

        // Substitui foto antiga se houver upload novo
        if ($request->hasFile('foto')) {
            if ($aluno->foto) Storage::disk('public')->delete($aluno->foto); // remove antiga
            $data['foto'] = $request->file('foto')->store('fotos', 'public'); // salva nova
        }

        $aluno->update($data); // atualiza registro
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado com sucesso!');
    }

    // Remove um aluno do banco
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        if ($aluno->foto) Storage::disk('public')->delete($aluno->foto); // remove foto
        $aluno->delete(); // exclui registro
        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso!');
    }
}
