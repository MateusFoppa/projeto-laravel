<?php

use App\Http\Controllers\EstoqueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/teste', function () {
//     return view('pagina1');
// });

// Route::get('/noticia/{id?}', function ($id = "NADA") {
//     return "Voce está lendo a notícia {$id}";
// });


Route::get('/estoque', [EstoqueController::class, 'index']) ->name('estoque');
