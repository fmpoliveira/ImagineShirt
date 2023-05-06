<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplinaRequest;
use App\Models\Disciplina;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $disciplinas = Disciplina::paginate(10);
        return view('disciplinas.index', compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $disciplina = new Disciplina();
        $cursos = Curso::all();
        return view('disciplinas.create')
            ->withDisciplina($disciplina)
            ->withCursos($cursos);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DisciplinaRequest $request): RedirectResponse
    {
        $newDisciplina = Disciplina::create($request->validated());
        $url = route('disciplinas.show', ['disciplina' => $newDisciplina]);
        $htmlMessage = "Disciplina <a href='$url'>#{$newDisciplina->id}</a>
        <strong>\"{$newDisciplina->nome}\"</strong> foi criada com sucesso!";
        return redirect()->route('disciplinas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disciplina $disciplina): View
    {
        $cursos = Curso::all();
        return view('disciplinas.show')
            ->with('disciplina', $disciplina)
            ->with('cursos', $cursos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disciplina $disciplina): View
    {
        $cursos = Curso::all();
        return view('disciplinas.edit', ['disciplina' => $disciplina, 'cursos' => $cursos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DisciplinaRequest $request, Disciplina $disciplina): RedirectResponse
    {
        $disciplina->update($request->validated());
        $url = route('disciplinas.show', ['disciplina' => $disciplina]);
        $htmlMessage = "Disciplina <a href='$url'>#{$disciplina->id}</a>
        <strong>\"{$disciplina->nome}\"</strong> foi alterada com sucesso!";
        return redirect()->route('disciplinas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disciplina $disciplina): RedirectResponse
    {
        // faz try catch por causa das foreign keys

        try {
            $totalDocentes = DB::scalar('select count(*) from docentes_disciplinas where disciplina_id = ?', [$disciplina->id]);
            $totalAlunos = DB::scalar('select count(*) from alunos_disciplinas where disciplina_id = ?', [$disciplina->id]);
            if ($totalDocentes == 0 && $totalAlunos == 0) {
                $disciplina->delete();
                $alertType = 'success';
                $htmlMessage = "Disciplina #{$disciplina->id}
                        <strong>\"{$disciplina->nome}\"</strong> foi apagada com sucesso!";
            } else {
                $url = route('disciplinas.show', ['disciplina' => $disciplina]);
                $alertType = 'warning';
                $docenteStr = $totalDocentes > 0 ?
                    ($totalDocentes == 1 ?
                        "1 docente a lecionar a disciplina" :
                        "$totalDocentes docentes a lecionar a disciplina") :
                    "";
                $alunoStr = $totalAlunos > 0 ?
                    ($totalAlunos == 1 ?
                        "1 aluno inscrito à disciplina" :
                        "$totalAlunos alunos inscritos à disciplina") :
                    "";
                if ($docenteStr && $alunoStr) {
                    $htmlMessage = "Disciplina <a href='$url'>#{$disciplina->id}</a>
                        <strong>\"{$disciplina->nome}\"</strong>
                        não pode ser apagada porque há $docenteStr e $alunoStr!
                        ";
                } else {
                    $htmlMessage = "Disciplina <a href='$url'>#{$disciplina->id}</a>
                        <strong>\"{$disciplina->nome}\"</strong>
                        não pode ser apagada porque há $docenteStr $alunoStr!
                        ";
                }
            }
        } catch (\Exception $error) {
            $url = route('disciplinas.show', ['disciplina' => $disciplina]);
            $htmlMessage = "Não foi possível apagar a disciplina <a href='$url'>#{$disciplina->id}</a>
                        <strong>\"{$disciplina->nome}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('disciplinas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
