<?php

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

Route::get('/', [ProductsController::class,'index']);
Route::get('/dashboard', [ProductsController::class,'dashboard'])->middleware('auth');
Route::get('/produto/adicionar', [ProductsController::class,'create'])->middleware('auth');
Route::get('/produto/disponiveis', [ProductsController::class,'copyProduct'])->middleware('auth');
Route::get('/produto/copiar/{id}', [ProductsController::class,'copy'])->middleware('auth');


Route::post('/produto',[ProductsController::class,'store']);
Route::get('/produto/{id}', [ProductsController::class,'show'])->where('id','[0-9]');;
Route::delete('/produtos/{id}',[ProductsController::class,'destroy'])->middleware('auth')->where('id','[0-9]');
Route::get('/produtos/edit/{id}',[ProductsController::class,'edit'])->middleware('auth')->where('id','[0-9]');
Route::put('/produtos/update/{id}',[ProductsController::class,'update'])->middleware('auth');
Route::put('/Editar/Usuario/{id}',[UserController::class,'update'])->middleware('auth');


Route::get('/usuario/Tipo_de_Acesso',[ProductsController::class,'acessLevel']);
Route::get('/Confirme',[UserController::class,'confirme']);
Route::get('/Endereco',[UserController::class,'endereco'])->middleware('auth')->name('Teste');
Route::post('/Endereco/Cadastrar',[UserController::class,'createEndereco'])->middleware('auth');
Route::put('/Endereco/Editar/{id}',[UserController::class,'editEndereco'])->middleware('auth');

Route::get('/Cadastrar/Usuario',[UserController::class,'typeUser'])->middleware('auth');






