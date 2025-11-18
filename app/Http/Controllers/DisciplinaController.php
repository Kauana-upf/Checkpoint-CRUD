<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;  // importa o model corretamente
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    // Lista disciplinas (obrigatório: paginação no index)
    public function index()
    {
        // GET usado pois estamos apenas buscando dados
        // paginate() habilita paginação obrigatória
        $disciplinas = Disciplina::paginate(10); // 10 registros por página
        return view('disciplinas.index', compact('disciplinas'));
    }

    // Formulário para criar disciplina
    public function create()
    {
        // GET usado pois só retorna formulário vazio
        return view('disciplinas.create');
    }

    // Salva nova disciplina no banco
    public function store(Request $request)
    {
        // POST usado pois estamos criando um novo recurso
        $request->validate([
            'nome' => 'required|string|max:255', // obrigatório
            'carga_horaria' => 'required|integer', // obrigatório
        ]);

        Disciplina::create($request->all()); // cria disciplina
        return redirect()->route('disciplinas.index'); // redireciona para lista
    }

    // Mostra detalhes de uma disciplina
    public function show(Disciplina $disciplina)
    {
        // GET usado pois só visualizamos dados
        return view('disciplinas.show', compact('disciplina'));
    }

    // Formulário para editar disciplina existente
    public function edit(Disciplina $disciplina)
    {
        // GET usado pois retorna formulário preenchido
        return view('disciplinas.edit', compact('disciplina'));
    }

    // Atualiza disciplina no banco
    public function update(Request $request, Disciplina $disciplina)
    {
        // PUT/PATCH usado pois estamos alterando um recurso existente
        $request->validate([
            'nome' => 'required|string|max:255', // obrigatório
            'carga_horaria' => 'required|integer', // obrigatório
        ]);

        $disciplina->update($request->all()); // atualiza dados
        return redirect()->route('disciplinas.index'); // redireciona para lista
    }

    // Remove disciplina do banco
    public function destroy(Disciplina $disciplina)
    {
        // DELETE usado pois excluímos um recurso (disciplina)
        $disciplina->delete();
        return redirect()->route('disciplinas.index'); // volta para lista
    }
}
