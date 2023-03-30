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
Route::get('/', [ProductsController::class,'index']);
Route::get('/dashboard', [ProductsController::class,'dashboard'])->middleware('auth');;
Route::get('/produto/adicionar', [ProductsController::class,'create'])->middleware('auth');
Route::post('/produto',[ProductsController::class,'store']);
Route::get('/produto/{id}', [ProductsController::class,'show']);
Route::delete('/produtos/{id}',[ProductsController::class,'destroy'])->middleware('auth');
Route::get('/produtos/{id}',[ProductsController::class,'edit'])->middleware('auth');

