<?php

use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Faker\Documentor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.login');
});



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

// Rotas para a lista de documentos
Route::get('/documents', [DocumentsController::class, 'index'])->name('documents')->middleware('auth');

// Apagar Documents
Route::get('/documents/apagar/{document}', [DocumentsController::class, 'apagar'])->name ('documents.apagar');

Route::delete('/documents/apagar/{document}', [DocumentsController::class, 'apagar']);


// Editar Documentos
Route::get('/documents/editar/{documents}', [EditorController::class, 'editar'])->name('documents.editar');

Route::put('/documents/editar/{documents}', [EditorController::class, 'editarGravar']);

// Listar Usuários
Route::get('/usuarios/{documents?}', [UserController::class, 'listarUsuarios'])->name('usuarios.listar');

// Compartilhar
Route::post('/documents/compartilhar/{documents?}', [DocumentsController::class, 'compartilhar'])->name('documents.compartilhar');

// Listar os Documentos Compartilhados
Route::get('/documents/compartilhados', [DocumentsController::class, 'compartilhados'])->name('documents.compartilhados');

// Rota de busca
Route::post('/documents/busca', [DocumentsController::class, 'busca'])->name('documents.busca');

// Visualizar documento em nova guia
Route::get('/documents/{id}/visualizar', [DocumentsController::class, 'visualizarDocumento'])->name('documents.visualizar');
