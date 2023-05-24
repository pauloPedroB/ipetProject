<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class CategoryController extends Controller
{
    public function index(){
        $User = auth()->user();
        $categories = Category::all();
        return view('products.createCategory',['User'=>$User,'categories'=>$categories]);
    }
    public function create(Request $request){
        $category = new Category;

        $category->name = $request->Name;
        $category->Description = 'a';

        $category->save();
        return redirect('/dashboard')->with('msg','Categoria adicionada com sucesso!');
    }
    public function edit($id){
        $category=Category::findOrFail($id);
        $User = auth()->user();
        return view('products.editCategory',['category' => $category,'User'=>$User]);
    }
    public function update(Request $request){
        $category = Category::findOrFail($request->id);;

        $category->name = $request->Name;
        $category->Description = $request->Description;

        $category->save();
        return redirect('/dashboard')->with('msg','Categoria Editada com sucesso!');
    }
    public function destroy($id){
        Category::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg','Categoria excluída com sucesso!');
    }
}
