<?php

use App\Http\Controllers\{
    UserController,
    ProductController,
    CategoryController,
    RequestController
};
use Illuminate\Support\Facades\Route;

// Rota da pagina inicial
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rotas de login/logout
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/auth', [UserController::class, 'auth'])->name('auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return back()->withInput();
});

// Rotas que precisa estar autenticado para entrar
Route::middleware('auth')->group(function () {
    // Rota da pagina inicial (quando esta autenticado)
    Route::get('/home/', [ProductController::class, 'index'])->name('user.index');

    // Rotas a respeito das categorias
    Route::get('/categorias', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categorias/cadastrar', [CategoryController::class, 'viewRegister'])->name('category.viewRegister');
    Route::post('/categorias/cadastrar/', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/categorias/produtos/{id}', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/categorias/editar/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categorias/editar/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categorias/excluir/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Rotas a respeito dos produtos
    Route::get('/produtos/cadastrar', [ProductController::class, 'viewRegister'])->name('product.viewRegister');
    Route::post('/produtos/cadastrar/criar', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produtos/editar/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produtos/atualizar/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produtos/excluir/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Rotas a respeito das requisicoes
    Route::get('/requisicoes', [RequestController::class, 'index'])->name('request.index');
    Route::get('/requisitar', [RequestController::class, 'requestView'])->name('request.requestView');
    Route::get('/requisitar/search', [RequestController::class, 'requestSearch'])->name('request.requestSearch');
    Route::get('/requisitar/request', [RequestController::class, 'request'])->name('request.request');

    // Rotas a respeito dos funcionarios
    Route::get('/funcionarios', [UserController::class, 'list'])->name('employee.list');
    Route::get('/funcionarios/cadastrar', [UserController::class, 'viewRegister'])->name('employee.viewRegister');
    Route::post('/funcionarios/cadastrar/create', [UserController::class, 'create'])->name('employee.create');
    Route::get('/funcionarios/editar/{id}', [UserController::class, 'edit'])->name('employee.edit');
    Route::put('/funcionarios/atualizar/{id}', [UserController::class, 'update'])->name('employee.update');
    Route::delete('/funcionarios/excluir/{id}', [UserController::class, 'destroy'])->name('employee.destroy');
});