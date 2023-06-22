<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\auth\ChangePasswordController;

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

Route::get('private/orders', [OrderController::class, 'indexPrivate'])->name('privateOrder.indexPrivate');

Route::get('private/orders/{order}', [OrderController::class, 'getPrivateOrder'])->name('privateOrder.showPrivate');
Route::get('private/orders/receipt/{orderID}', [OrderController::class, 'getReceipt'])->name('orders.getReceipt');

Route::resource('orders', OrderController::class);

Route::get('orderManager', [OrderController::class, 'indexAdmin'])->name('orders.admin');

// -------------- PRIVATE IMAGES --------------

// Route::middleware('auth')->group(function () {
Route::get('private/tshirts', [TshirtImageController::class, 'indexPrivate'])->name('privateTshirt.indexPrivate');
Route::get('private/tshirts/{imagePath}', [TshirtImageController::class, 'getPrivateImage'])->name('private.image');
// });

// Route::middleware(['auth', 'can:view-private-images'])->group(function () {
Route::get('private/tshirts/{tshirt}', [TshirtImageController::class, 'showPrivate'])->name('privateTshirt.showPrivate');
Route::get('private/tshirts/{tshirt}/edit', [TshirtImageController::class, 'editPrivate'])->name('privateTshirt.editPrivate');
Route::put('private/{tshirt}', [TshirtImageController::class, 'updatePrivate'])->name('privateTshirt.updatePrivate');
Route::delete('private/{tshirt}', [TshirtImageController::class, 'destroyPrivate'])->name('privateTshirt.destroyPrivate');
// });

// --------------------------------------------


Route::get('tshirtManager', [TshirtImageController::class, 'indexAdmin'])->name('tshirts.admin');
Route::resource('tshirts', TshirtImageController::class);

Route::resource('disciplinas', DisciplinaController::class);

Route::resource('colors', ColorController::class);

Route::resource('users', UserController::class);

Route::resource('customers', CustomerController::class);

Route::resource('categories', CategoryController::class);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('teste', 'template.layout');

Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])
    ->name('users.foto.destroy');

Route::delete('users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');

Route::delete('customers/{customer}/foto', [CustomerController::class, 'destroy_foto'])
    ->name('customers.foto.destroy');

Route::post('users/store', [UserController::class, 'store'])->name('users.store');

Route::post('/users/{user}/block', [UserController::class, 'block'])->name('users.block');

// Show the cart:

Route::get('/cart/{color}/{tshirt}', [TshirtImageController::class, 'placeCanvasOnView'])->name('canvas.image');

Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::post('cart/refresh', [CartController::class, 'refresh'])->name('cart.refresh');

Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');

Route::match(['post', 'get'], 'cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');

Route::post('cart/{tshirt}', [CartController::class, 'addToCart'])->name('cart.add');

Route::delete('cart/{tshirt}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/password/change', [ChangePasswordController::class, 'show'])->name('password.change.show');
Route::post('/password/change', [ChangePasswordController::class, 'store'])->name('password.change.store');
