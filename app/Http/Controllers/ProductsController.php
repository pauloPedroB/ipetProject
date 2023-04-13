<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Endereco;
use App\Models\Loja;
use App\Models\Usuario;





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


        $User = auth()->user();
        if($User){
            $loja = Loja::where([
                [
                    'user_id','=',$User->id
                ]
            ])->get();
            if($loja==null){
                $loja = Usuario::where([
                    [
                        'user_id','=',$User->id
                    ]
                ]);
                if($loja==null){
                    $loja = 'nudasfadsfdaslo';
                }
            }
        }
        else{
            $loja='uiugf';
        }
        $Loja = '';
        $Enderecos = Endereco::all();
       
        return view('welcome',['products'=>$products,'search' => $search,'Enderecos'=>$Enderecos,'User'=>$User,
        'dlon'=>0,'dlat'=>0,'a'=>0,'c'=>0,'r'=>0,'d'=>0,'latUser'=>0,'longUser'=>0,'loja'=>$loja]);
    }
    public function create(){
        $User = auth()->user();
        return view('products.create',['User'=>$User]);
    }
    public function copyProduct(){
        $search = request('search');
        if($search){
            $products = Product::where([
                ['name','like','%'.$search.'%']
            ])->get();
        }
        else{
            $products = Product::where([['user_id','=','1']])->get();
        }
        return view('products.copyProduct',['products'=>$products,'search' => $search]);
    }
    public function copy($id){

        $product = Product::findOrFail($id);
        $newProduct = new Product;

        $newProduct->Name = $product->Name;
        $newProduct->Description = $product->Description;
        $newProduct->Value = $product->Value;
        $newProduct->Specifications = $product->Specifications;
        $newProduct->Category = $product->Specifications;
        $newProduct->Weight = $product->Weight;
        $newProduct->Image = $product->Image;
        
        $user = auth()->user();
        $newProduct->user_id = $user->id;
        $newProduct->Endereco_id = $user->Endereco_id;
        $newProduct->save();

        return redirect('/produto/disponiveis')->with('msg','Produto adicionado com sucesso!');
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
        $product->Endereco_id = $user->Endereco_id;
        $product->save();

        return redirect('/dashboard')->with('msg','Produto adicionado com sucesso!');
    }
    public function show($id){
        $Enderecos = Endereco::all();
        $product = Product::findOrFail($id);
        $productOwner = User::where('id',$product->user_id)->first()->toArray();
        return view('products.show',['product'=> $product,'productOwner'=>$productOwner,'Enderecos'=>$Enderecos]);
    }
    public function dashboard(){
        $user = auth()->user();
        $Enderecos = Endereco::all();

        $products = $user->products;


        return view('products.dashboard',['products' =>$products,'user'=>$user,'Enderecos'=>$Enderecos]);
    }
    public function destroy($id){
        Product::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg','Produto excluído com sucesso!');
    }
    public function edit($id){
        $product=Product::findOrFail($id);

        return view('products.edit',['product' => $product]);
    }
    public function update(Request $request){
        Product::findOrFail($request->id)->update($request->all());
        return redirect('/dashboard')->with('msg','Produto Editado com sucesso!');
    }
}
