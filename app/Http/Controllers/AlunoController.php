<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::paginate(5);
        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            // aceitar ambos: status (Ativo/Inativo) ou ativo (1/0)
            'status' => 'nullable|in:Ativo,Inativo',
            'ativo' => 'nullable|in:0,1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // converter para o campo booleano 'ativo'
        if (isset($data['status'])) {
            $data['ativo'] = $data['status'] === 'Ativo' ? 1 : 0;
            unset($data['status']);
        } elseif (isset($data['ativo'])) {
            $data['ativo'] = (int) $data['ativo'];
        } else {
            // padrão se nada informado
            $data['ativo'] = 1;
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Aluno::create($data);
        return redirect()->route('alunos.index')->with('success', 'Aluno criado com sucesso!');
    }

    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.show', compact('aluno'));
    }

    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            // aceitar ambos: status (Ativo/Inativo) ou ativo (1/0)
            'status' => 'nullable|in:Ativo,Inativo',
            'ativo' => 'nullable|in:0,1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // converter para o campo booleano 'ativo'
        if (isset($data['status'])) {
            $data['ativo'] = $data['status'] === 'Ativo' ? 1 : 0;
            unset($data['status']);
        } elseif (isset($data['ativo'])) {
            $data['ativo'] = (int) $data['ativo'];
        }

        if ($request->hasFile('foto')) {
            if ($aluno->foto) {
                Storage::disk('public')->delete($aluno->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $aluno->update($data);
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        if ($aluno->foto) {
            Storage::disk('public')->delete($aluno->foto);
        }
        $aluno->delete();
        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso!');
    }
}
