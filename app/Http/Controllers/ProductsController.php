<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductsController extends Controller
{
    public function index(){

        $search = request('search');
        if($search){
            $products = Product::where([
                ['name','like','%'.$search.'%']
            ])->get();
        }
        else{
            $products = Product::all();
        }

        return view('welcome',['products'=>$products,'search' => $search]);
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        $product = new Product;

        $product->Name = $request->Name;
        $product->Description = $request->Description;
        $product->Value = $request->Value;
        $product->Specifications = $request->Specifications;
        $product->Category = $request->Specifications;
        $product->Weight = $request->Weight;
        

        
        

        //image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime('now')) . ".".$extension;
            $requestImage->move(public_path('img/products'),$imageName);
            $product->image = $imageName;
        }
        $user = auth()->user();
        $product->user_id = $user->id;
        $product->save();

        return redirect('/')->with('msg','Produto adicionado com sucesso!');
    }
    public function show($id){
        $product = Product::findOrFail($id);
        $productOwner = User::where('id',$product->user_id)->first()->toArray();
        return view('products.show',['product'=> $product,'productOwner'=>$productOwner]);
    }
}
