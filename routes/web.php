<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Models\Categorie;
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

Route::middleware('auth')->group(function () {
    Route::get('/categorias', [CategorieController::class, 'index'])->name('home.categorie');
    Route::get('/categorias/cadastrar', [CategorieController::class, 'viewRegister'])->name('viewRegister.categorie');
    Route::post('/categorias/cadastrar/criar', [CategorieController::class, 'create'])->name('create.categorie');
    Route::get('/categorias/editar/{id}', [CategorieController::class, 'edit'])->name('edit.categorie');
    Route::get('/categorias/excluir/{id}', [CategorieController::class, 'delete'])->name('delete.categorie');

    Route::middleware(['employee'])->group(function () {
        Route::get('/funcionario', [EmployeeController::class, 'index'])->name('home.employee');
    });

    Route::middleware(['coordinator'])->group(function () {
        Route::get('/cordenador', [CoordinatorController::class, 'index'])->name('home.coordinator');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('home.admin');
    });
});