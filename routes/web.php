<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque')->middleware('auth');

Route::post('/estoque/busca', [EstoqueController::class, 'busca'])->name('estoque.busca');

Route::get('/estoque/adicionar', [EstoqueController::class, 'adicionar'])->name('estoque.adicionar');

Route::post('/estoque/adicionar', [EstoqueController::class, 'adicionarGravar']);

Route::get('/estoque/editar/{estoque}', [EstoqueController::class, 'editar'])->name('estoque.editar');

Route::put('/estoque/adicionar', [EstoqueController::class, 'editarGravar']);

Route::get('/estoque/apagar/{estoque}', [EstoqueController::class, 'apagar'])->name ('estoque.apagar');

Route::delete('/estoque/apagar/{estoque}', [EstoqueController::class, 'apagar']);

//Grupo para rotas que comecem com /user
Route::group(['prefix' => '/user'], function () {

    Route::get('', [UserController::class, 'index'])->name('user');

    Route::get('/create', [UserController::class, 'create'])->name('user.create');

    Route::post('/create', [UserController::class, 'createSave'])->name('createSave');

    Route::get('/login', [UserController::class, 'login'])->name('user.login');

    Route::post('/login', [UserController::class, 'login'])->name('user.login');

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::get('/upload', [UploadController::class, 'index'])->name('upload');

Route::post('/upload/save', [UploadController::class, 'save'])->name('upload.save');


//Rotas para o editor de texto
Route::get('/editor', [EditorController::class, 'index'])->name('editor');

Route::post('/editor/save', [EditorController::class, 'save'])->name('editor.save');

// Route::get('/teste', function() {
//     return 'O teste funcionou';
// });
// Route::get('/teste-com-view', function() {
//     return view('teste');
// });
// Route::get('/noticia/{id?}', function($id = 'NADA') {
//     return "Você está lendo a notícia {$id}";
// });