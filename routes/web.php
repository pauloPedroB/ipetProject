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
Route::get('/produto/adicionar', [ProductsController::class,'create']);
Route::post('/produto',[ProductsController::class,'store']);

