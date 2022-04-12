<?php

use App\Http\Controllers\{
    UserController,
    ProductController,
    CategorieController
};
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/auth', [UserController::class, 'auth'])->name('auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return back()->withInput();
});

Route::middleware('auth')->group(function () {
    Route::get('/home/', [ProductController::class, 'home'])->name('home.user');

    Route::get('/categorias', [CategorieController::class, 'index'])->name('home.categorie');
    Route::get('/categorias/cadastrar', [CategorieController::class, 'viewRegister'])->name('viewRegister.categorie');
    Route::post('/categorias/cadastrar/criar', [CategorieController::class, 'create'])->name('create.categorie');
    Route::get('/categorias/produtos/{id}', [CategorieController::class, 'list'])->name('list.categorie');
    Route::get('/categorias/editar/{id}', [CategorieController::class, 'edit'])->name('edit.categorie');
    Route::put('/categorias/atualizar/{id}', [CategorieController::class, 'update'])->name('update.categorie');
    Route::delete('/categorias/excluir/{id}', [CategorieController::class, 'destroy'])->name('delete.categorie');

    Route::get('/produtos/cadastrar', [ProductController::class, 'viewRegister'])->name('viewRegister.product');
    Route::post('/produtos/cadastrar/criar', [ProductController::class, 'create'])->name('create.product');
    Route::get('/produtos/editar/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::put('/produtos/atualizar/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('/produtos/excluir/{id}', [ProductController::class, 'destroy'])->name('delete.product');

    Route::get('/requisicoes', [ProductController::class, 'requests'])->name('home.requests');
    Route::get('/requisitar', [ProductController::class, 'requestView'])->name('requestView');
    Route::get('/requisitar/search', [ProductController::class, 'requestSearch'])->name('requestSearch');
    Route::get('/requisitar/request', [ProductController::class, 'request'])->name('request');

    Route::get('/funcionarios', [UserController::class, 'list'])->name('home.employee');
    Route::get('/funcionarios/cadastrar', [UserController::class, 'viewRegister'])->name('viewRegister.employee');
    Route::post('/funcionarios/cadastrar/create', [UserController::class, 'create'])->name('create.employee');
    Route::get('/funcionarios/editar/{id}', [UserController::class, 'edit'])->name('edit.employee');
    Route::put('/funcionarios/atualizar/{id}', [UserController::class, 'update'])->name('update.employee');
    Route::delete('/funcionarios/excluir/{id}', [UserController::class, 'destroy'])->name('delete.employee');
});