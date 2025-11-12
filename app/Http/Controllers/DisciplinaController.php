<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;  // importa o model corretamente
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index()
    {
        // Alterado: usar paginate() no lugar de all() para habilitar paginação
        $disciplinas = Disciplina::paginate(10); // 10 registros por página
        return view('disciplinas.index', compact('disciplinas'));
    }

    public function create()
    {
        return view('disciplinas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|integer',
        ]);

        Disciplina::create($request->all());
        return redirect()->route('disciplinas.index');
    }

    public function show(Disciplina $disciplina)
    {
        return view('disciplinas.show', compact('disciplina'));
    }

    public function edit(Disciplina $disciplina)
    {
        return view('disciplinas.edit', compact('disciplina'));
    }

    public function update(Request $request, Disciplina $disciplina)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|integer',
        ]);

        $disciplina->update($request->all());
        return redirect()->route('disciplinas.index');
    }

    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();
        return redirect()->route('disciplinas.index');
    }
}
