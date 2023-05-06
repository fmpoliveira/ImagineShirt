<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\TshirtController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::view('/', 'home')->name('root');

// REPLACE THESE 7 ROUTES:
// Route::get('tshirts', [TshirtController::class, 'index'])->name('tshirts.index');
// Route::get('cursos/{curso}', [CursoController::class, 'show'])->name('cursos.show');
// Route::get('cursos/create', [CursoController::class, 'create'])->name('cursos.create');
// Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store');
// Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
// Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
// Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');

// WITH A SINGLE LINE OF CODE:
Route::resource('tshirts', TshirtController::class);

Route::resource('disciplinas', DisciplinaController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('teste', 'template.layout');
