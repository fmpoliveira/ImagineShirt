<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Tshirt;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CursoController extends Controller
{
    public function index(): View
    {
        // $allCursos = Curso::all();
        // debug($allCursos);
        // Log::debug('Cursos has been loaded on the controller.', ['$allCursos' => $allCursos]);
        // return view('cursos.index')->with('cursos', $allCursos);

        $allTshirts = Tshirt::all();
        debug($allTshirts);
        Log::debug('Cursos has been loaded on the controller.', ['$allTshirts' => $allTshirts]);
        return view('cursos.index')->with('cursos', $allTshirts);
    }

    public function show(Curso $curso): View
    {
        return view('cursos.show')->withCurso($curso);
    }

    public function create(): View
    {
        $newCurso = new Curso();
        return view('cursos.create')->withCurso($newCurso);
    }

    public function store(Request $request): RedirectResponse
    {
        Curso::create($request->all());
        return redirect()->route('cursos.index');
    }

    public function edit(Curso $curso): View
    {
        return view('cursos.edit')->withCurso($curso);
    }

    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $curso->update($request->all());
        return redirect()->route('cursos.index');
    }

    public function destroy(Curso $curso): RedirectResponse
    {
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
