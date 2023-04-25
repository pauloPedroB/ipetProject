<?php

use App\Http\Controllers\CategoryController;
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
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Loja;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AvaliationsController;


//  AGRUPAMENTO DE ROTAS POR CONTROLLER - OPTIONS (CONTROLLER, PREFIX, NAME, MIDLEWARE) PODENDO SER ENCADEADOS
// Route::controller('ProductsController::class')->group(
//     function () {
//         Route::get('/', 'index');
//         Route::get('/dashboard', 'dashboard')->middleware('auth');
//         Route::get('/produto/adicionar', 'create')->middleware('auth');
//         Route::get('/produto/disponiveis', 'copyProduct')->middleware('auth');
//         Route::get('/produto/copiar/{id}', 'copy')->middleware('auth');

//         Route::post('/produto', 'store');
//         Route::get('/produto/{id}', 'show')->where('id', '[0-9]');;
//         Route::delete('/produtos/{id}', 'destroy')->middleware('auth')->where('id', '[0-9]');
//         Route::get('/produtos/edit/{id}', 'edit')->middleware('auth')->where('id', '[0-9]');
//         Route::put('/produtos/update/{id}', 'update')->middleware('auth');

//         Route::get('/usuario/Tipo_de_Acesso', 'acessLevel');
//     }
// );
// Route::controller('UserController::class')->group(
//     function () {
//         Route::put('/Editar/Usuario/{id}', 'update')->middleware('auth');

//         Route::get('/Confirme', 'confirme');
//         Route::get('/Endereco', 'endereco')->middleware('auth')->name('Teste');
//         Route::post('/Endereco/Cadastrar', 'createEndereco')->middleware('auth');
//         Route::put('/Endereco/Editar/{id}', 'editEndereco')->middleware('auth');

//         Route::get('/Cadastrar/Usuario', 'typeUser')->middleware('auth');
//     }
// );

Route::get('/tela/{view}', function ($view) {
    return view($view);
});

Route::get('/', [ProductsController::class, 'index']);
Route::get('/dashboard', [ProductsController::class, 'dashboard'])->middleware('auth');
Route::get('/produto/adicionar', [ProductsController::class, 'create'])->middleware('auth', 'CheckADM');
Route::get('/produto/disponiveis', [ProductsController::class, 'copyProduct'])->middleware('auth', 'CheckLoja');
Route::get('/produto/copiar/{id}', [ProductsController::class, 'copy'])->middleware('auth', 'CheckLoja');


Route::post('/produto', [ProductsController::class, 'store'])->middleware('auth', 'CheckADM');;
Route::get('/produto/{id}', [ProductsController::class, 'show'])->where('id', '[0-9]');;
Route::delete('/produtos/{id}', [ProductsController::class, 'destroy'])->middleware('auth', 'CheckLoja')->where('id', '[0-9]');
Route::get('/produtos/edit/{id}', [ProductsController::class, 'edit'])->middleware('auth', 'CheckLoja')->where('id', '[0-9]');
Route::put('/produtos/update/{id}', [ProductsController::class, 'update'])->middleware('auth', 'CheckLoja');
Route::get('/Tipo/Usuario', [UserController::class, 'typeUser'])->middleware('auth');

Route::get('/Registar/Loja', [LojaController::class, 'index'])->middleware('auth');
Route::post('/Cadastrar/Loja', [LojaController::class, 'create'])->middleware('auth');

Route::get('/Registar/Usuario', [UsuarioController::class, 'index'])->middleware('auth');
Route::post('/Cadastrar/Usuario', [UsuarioController::class, 'create'])->middleware('auth');



Route::get('/usuario/Tipo_de_Acesso', [ProductsController::class, 'acessLevel']);
Route::get('/Endereco', [UserController::class, 'endereco'])->middleware('auth');
Route::post('/Endereco/Cadastrar', [UserController::class, 'createEndereco'])->middleware('auth');
Route::put('/Endereco/Editar/{id}', [UserController::class, 'editEndereco'])->middleware('auth');

Route::get('/categoria/adicionar', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/categoria', [CategoryController::class, 'create'])->middleware('auth');
Route::delete('/categoria/{id}', [CategoryController::class, 'destroy'])->middleware('auth');

Route::post('/avaliar', [AvaliationsController::class, 'create'])->middleware('auth', 'CheckUsuario');