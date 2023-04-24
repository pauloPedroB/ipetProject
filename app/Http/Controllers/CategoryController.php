<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class CategoryController extends Controller
{
    public function index(){
        $User = auth()->user();
        return view('products.createCategory',['User'=>$User]);
    }
    public function create(Request $request){
        $category = new Category;

        $category->name = $request->Name;
        $category->Description = $request->Description;

        $category->save();
        return redirect('/dashboard')->with('msg','Categoria adicionada com sucesso!');
    }
    public function destroy($id){
        Category::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg','Categoria excluída com sucesso!');
    }
}