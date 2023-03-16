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

Route::get('/', function () {
    $nome ="Mateus";
    $idade = 29;
    $arr=[1,2,'13',4,'fdsf'];
    $nomes=['jorge','pedro','augusto'];
    return view('welcome',
     [
        'nome'=>$nome,
        'idade' => $idade,
        'arr' => $arr,
        'nomes'=>$nomes
    
    ]);
});
Route::get('/opa', function () {
    $busca = request('search');
    return view('opa',['busca'=>$busca]);
});
Route::get('/produtos/{id?}', function ($id =null) {
    return view('product',['id' =>$id]);
});
