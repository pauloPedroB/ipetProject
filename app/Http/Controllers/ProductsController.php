<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Endereco;
use App\Models\Loja;
use App\Models\Usuario;
use App\Models\productsLoja;






class ProductsController extends Controller
{
    public function index(){

        $search = request('search');
        if($search){
            $products = productsLoja::join('products','products.id','=','products_Lojas.Product_id')
            ->join('users','products.user_id','=','users.id')
            ->join('lojas','lojas.id','=','products_Lojas.Loja_id')
            ->where([['name','like','%'.$search.'%']])
            ->get();
        }
        else{
            $products = productsLoja::join('products','products.id','=','Product_id')
                                ->join('users','products.user_id','=','users.id')
                                ->join('lojas','lojas.id','=','Loja_id')
                                ->get();
        }

        $User = auth()->user();
        if($User){
            $loja = Loja::where([
                [
                    'user_id','=',$User->id
                ]
            ])->get();

            if(count($loja)==0){
                $loja = Usuario::where([
                    [
                        'user_id','=',$User->id
                    ]
                ])->get();
                if(count($loja)==0){
                    $loja = null;
                }
            }
            
        }
        else{
            $loja='teste';
        }
        $Enderecos = Endereco::all();
        $end = false;
        $id_end = 0;
        if($loja==null && $User->AL_id !=3){
            return redirect('/Tipo/Usuario');
        }
        else{
            if($User && $User->AL_id!=3)
            {
                foreach($loja as $loj){
                    if($loj->Endereco_id == null)
                    {
                        $end = true;
                    }
                    else{
                        $id_end=$loj->Endereco_id;
                    }
               }
            }
           
        }
        if($end == true && $User->AL_id !=3){
            return redirect('/Endereco');
        }
        else{
            return view('welcome',['products'=>$products,'search' => $search,'Enderecos'=>$Enderecos,'User'=>$User,
        'dlon'=>0,'dlat'=>0,'a'=>0,'c'=>0,'r'=>0,'d'=>0,'latUser'=>0,'longUser'=>0,'id_end'=>$id_end]);
        }
       
        
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
            $products = Product::join('users','products.user_id','=','users.id')
                                ->where('users.AL_id','=',3)
                                ->select('users.id as id_U','products.id as id','Name','Image','User_id')
                                ->get();
        }
        $user = auth()->user();
        $lojas = Loja::all();
        $Loja = '';
        foreach($lojas as $loja){
            if($loja->User_id == $user->id){
                $Loja = $loja->id;
            }

        }
        if($Loja!=null){
            $myproducts = productsLoja::where('Loja_id','=',$Loja->id);
        }
        else{
            $myproducts = null;
        }
        return view('products.copyProduct',['products'=>$products,'search' => $search,'myproducts'=>$myproducts]);
    }
    public function copy($id){
        $user = auth()->user();
        $product = Product::findOrFail($id);
        $newProduct = new productsLoja;
        $lojas = Loja::all();
        foreach($lojas as $loja){
            if($loja->user_id == $user->id){
                $newProduct->Loja_id = $loja->id;
            }
        }
        $newProduct->Product_id = $product->id;

        
        $newProduct->save();

        return redirect('/produto/disponiveis')->with('msg','Produto adicionado com sucesso!');
    }
    public function store(Request $request){

        $inputs = [];
        foreach ($request as $name => $value) {
            if (strpos($name, 'input-') === 0) {
                $inputs[$value] = $value;
            }
        }

        $product = new Product;

        $product->Name = $request->Name;
        $product->Description = implode('<>',$inputs);

        
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
        $loja = Loja::where([['user_id','=',$user->id]])->get();
        foreach($loja as $loj)
        {
            if($loj->user_id == $user->id){
                $product->Endereco_id = $loj->Endereco_id;
                break;
            }
        }
        $product->save();

        return redirect('/dashboard')->with('msg','Produto adicionado com sucesso!');
    }
    public function show($id){
        $Enderecos = Endereco::all();
        $products = productsLoja::findOrFail($id)
                        ->join('products','products.id','=','products_Lojas.Product_id')
                        ->join('users','products.user_id','=','users.id')
                        ->join('lojas','lojas.id','=','products_Lojas.Loja_id')
                        ->get();
        foreach($products as $product){
            if($product->id == $id){
                return view('products.show',['product'=> $product,'Enderecos'=>$Enderecos]);
                
            }
        }
    }
    public function dashboard(){
        $user = auth()->user();
        $Enderecos = Endereco::all();

       
        $loja = Loja::where([
            [
                'user_id','=',$user->id
            ]
        ])->get();

        if(count($loja)==0){
            $loja = Usuario::where([
                [
                    'user_id','=',$user->id
                ]
            ])->get();
            if(count($loja)==0){
                $loja = null;
            }
        }
        $Loja = '';
        if($user->AL_id !=3)
        {
            foreach($loja as $loj){
                if($loj->user_id==$user->id)
                {
                    $Loja = $loj;
                }
           }
        }
       
        
        if($user->AL_id !=3){
            $products = productsLoja::join('products','products.id','=','products_Lojas.Product_id')
            ->where('products_Lojas.Loja_id','=',$Loja->id)
            ->select('products.id as id_U','products_Lojas.id as id','Name','User_id')
            ->get();
        }
        else{
            $products = Product::all();
        }
       


        return view('products.dashboard',['products' =>$products,'user'=>$user,'Enderecos'=>$Enderecos,'Loja'=>$Loja]);
    }
    public function destroy($id){
        $user = auth()->user();
        if($user->AL_id != 3){
            productsLoja::findOrFail($id)->delete();
        }
        else{
            Product::findOrFail($id)->delete();
        }
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
