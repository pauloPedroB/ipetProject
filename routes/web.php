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
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/tela/{view}', function ($view) {
    return view($view);
});

Route::get('/', [ProductsController::class, 'index'])->middleware('CheckType');
Route::get('/dashboard', [ProductsController::class, 'dashboard'])->middleware('auth', 'CheckType');
Route::get('/produto/adicionar', [ProductsController::class, 'create'])->middleware('auth', 'CheckADM');
Route::get('/produto/disponiveis', [ProductsController::class, 'copyProduct'])->middleware('auth', 'CheckLoja');
Route::get('/produto/copiar/{id}', [ProductsController::class, 'copy'])->middleware('auth', 'CheckLoja');


Route::post('/produto', [ProductsController::class, 'store'])->middleware('auth', 'CheckADM');;
Route::get('/produto/{id}/{prod?}', [ProductsController::class, 'show'])->where('id', '[0-9]{1,3}')->middleware('CheckType');
Route::delete('/produtos/{id}', [ProductsController::class, 'destroy'])->middleware('auth', 'CheckLoja')->where('id', '[0-9]{1,3}');
Route::get('/produtos/edit/{id}', [ProductsController::class, 'edit'])->middleware('auth', 'CheckLoja')->where('id', '[0-9]{1,3}');
Route::put('/produtos/update/{id}', [ProductsController::class, 'update'])->middleware('auth', 'CheckLoja');

Route::get('/Tipo/Usuario', [UserController::class, 'typeUser'])->middleware('auth');

Route::get('/Registrar/Loja', [LojaController::class, 'index'])->middleware('auth');
Route::post('/Cadastrar/Loja', [LojaController::class, 'create'])->middleware('auth');
Route::get('/Editar/Loja/{id}', [LojaController::class, 'edit'])->middleware('auth', 'CheckType');
Route::put('/Update/Loja/{id}', [LojaController::class, 'update'])->middleware('auth', 'CheckType');


Route::get('/Registrar/Usuario', [UsuarioController::class, 'index'])->middleware('auth');
Route::post('/Cadastrar/Usuario', [UsuarioController::class, 'create'])->middleware('auth');

Route::get('/usuario/Tipo_de_Acesso', [ProductsController::class, 'acessLevel'])->middleware('CheckNotType');

Route::get('/categoria/adicionar', [CategoryController::class, 'index'])->middleware('auth', 'CheckADM');
Route::post('/categoria', [CategoryController::class, 'create'])->middleware('auth', 'CheckADM');
Route::get('/categoria/{id}', [CategoryController::class, 'edit'])->middleware('auth', 'CheckADM');
Route::put('/categoria/editar/{id}', [CategoryController::class, 'update'])->middleware('auth', 'CheckADM');
Route::delete('/categoria/{id}', [CategoryController::class, 'destroy'])->middleware('auth', 'CheckADM');

Route::post('/avaliar', [AvaliationsController::class, 'create'])->middleware('auth', 'CheckUsuario');


Route::get('/pacote',[LojaController::class, 'premiumIndex'])->middleware('auth', 'CheckType','CheckLoja','CheckPremium');
Route::get('/premium',[LojaController::class, 'premium'])->middleware('auth', 'CheckType','CheckLoja','CheckPremium');
Route::get('/payment',[LojaController::class, 'payment'])->middleware('auth', 'CheckType','CheckLoja','CheckPremium');
Route::get('/pix',[LojaController::class, 'pix'])->middleware('auth', 'CheckType','CheckLoja','CheckPremium');


Route::post('/entrando',[AuthController::class, 'index']);
Route::post('/registrando',[AuthController::class, 'register']);
Route::post('/deletando',[UserController::class, 'destroy']);

Route::get('/avaliação/loja/{id}', [AvaliationsController::class, 'index']);
