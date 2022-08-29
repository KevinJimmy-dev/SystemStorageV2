<?php

use App\Http\Controllers\{
    AuthController,
    UserController,
    ProductController,
    CategoryController,
    RequestController
};
use Illuminate\Support\Facades\Route;

// Route of the initial page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Routes of authentication
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login/auth', [AuthController::class, 'auth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return back()->withInput();
});

// Routes that need to be authenticated
Route::middleware('auth')->group(function () {
    // Route of the initial page (authenticated)
    Route::get('/home', [ProductController::class, 'index'])->name('user.index');

    // Routes of the categories
    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/cadastrar', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/cadastrar', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/produtos/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/editar/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/editar/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/excluir/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Routes of the products
    Route::prefix('produtos')->group(function () {
        Route::get('/cadastrar', [ProductController::class, 'create'])->name('product.create');
        Route::post('/cadastrar', [ProductController::class, 'store'])->name('product.store');
        Route::get('/editar/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/atualizar/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/excluir/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Routes of the requests
    Route::prefix('requisicoes')->group(function () {
        Route::get('/', [RequestController::class, 'index'])->name('request.index');
        Route::get('/requisitar', [RequestController::class, 'create'])->name('request.create');
        Route::get('/requisitar/search', [RequestController::class, 'search'])->name('request.search');
        Route::get('/requisitar/request', [RequestController::class, 'request'])->name('request.request');
    });

    // Routes of the employees
    Route::prefix('funcionarios')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('employee.show');
        Route::get('/cadastrar', [UserController::class, 'create'])->name('employee.create');
        Route::post('/cadastrar', [UserController::class, 'store'])->name('employee.store');
        Route::get('/editar/{id}', [UserController::class, 'edit'])->name('employee.edit');
        Route::put('/editar/{id}', [UserController::class, 'update'])->name('employee.update');
        Route::delete('/excluir/{id}', [UserController::class, 'destroy'])->name('employee.destroy');
    });
});