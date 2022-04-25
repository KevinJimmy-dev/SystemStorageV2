<?php

use App\Http\Controllers\{
    UserController,
    ProductController,
    CategorieController
};
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;


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
    Route::get('/home/', [ProductController::class, 'index'])->name('user.index');

    Route::get('/categorias', [CategorieController::class, 'index'])->name('category.index');
    Route::get('/categorias/cadastrar', [CategorieController::class, 'viewRegister'])->name('category.viewRegister');
    Route::post('/categorias/cadastrar/criar', [CategorieController::class, 'create'])->name('category.create');
    Route::get('/categorias/produtos/{id}', [CategorieController::class, 'list'])->name('category.list');
    Route::get('/categorias/editar/{id}', [CategorieController::class, 'edit'])->name('category.edit');
    Route::put('/categorias/atualizar/{id}', [CategorieController::class, 'update'])->name('category.update');
    Route::delete('/categorias/excluir/{id}', [CategorieController::class, 'destroy'])->name('category.destroy');

    Route::get('/produtos/cadastrar', [ProductController::class, 'viewRegister'])->name('product.viewRegister');
    Route::post('/produtos/cadastrar/criar', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produtos/editar/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produtos/atualizar/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produtos/excluir/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/requisicoes', [ProductController::class, 'HomeRequests'])->name('request.HomeRequests');
    Route::get('/requisitar', [ProductController::class, 'requestView'])->name('request.requestView');
    Route::get('/requisitar/search', [ProductController::class, 'requestSearch'])->name('request.requestSearch');
    Route::get('/requisitar/request', [ProductController::class, 'request'])->name('request.request');

    Route::get('/funcionarios', [UserController::class, 'list'])->name('employee.list');
    Route::get('/funcionarios/cadastrar', [UserController::class, 'viewRegister'])->name('employee.viewRegister');
    Route::post('/funcionarios/cadastrar/create', [UserController::class, 'create'])->name('employee.create');
    Route::get('/funcionarios/editar/{id}', [UserController::class, 'edit'])->name('employee.edit');
    Route::put('/funcionarios/atualizar/{id}', [UserController::class, 'update'])->name('employee.update');
    Route::delete('/funcionarios/excluir/{id}', [UserController::class, 'destroy'])->name('employee.destroy');
});