<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;

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
// Route::get('cart/{customer}', [TshirtController::class, 'index'])->name('tshirts.index');

Route::resource('prices', PriceController::class);

Route::resource('orderItems', OrderItemController::class);

Route::resource('orders', OrderController::class);
Route::get('order/mine', [OrderController::class, 'myOrders'])->name('order.mine');

Route::get('admin/tshirts', [TshirtImageController::class, 'indexAdmin'])->name('tshirts.admin');
Route::resource('tshirts', TshirtImageController::class);

Route::resource('disciplinas', DisciplinaController::class);

Route::resource('colors', ColorController::class);

Route::resource('customers', CustomerController::class);

Route::resource('categories', CategoryController::class);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('teste', 'template.layout');


// Show the cart:
Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::post('cart/{tshirt}', [CartController::class, 'addToCart'])->name('cart.add');

Route::delete('cart/{tshirt}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('cart', [CartController::class, 'store'])->name('cart.store');

Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/password/change', [App\Http\Controllers\auth\ChangePasswordController::class, 'show'])->name('password.change.show');
Route::post('/password/change', [App\Http\Controllers\auth\ChangePasswordController::class, 'store'])->name('password.change.store');
