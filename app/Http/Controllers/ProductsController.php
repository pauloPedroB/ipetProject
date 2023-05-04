<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Endereco;
use App\Models\Loja;
use App\Models\Usuario;
use App\Models\productsLoja;
use App\Models\Category;
use App\Models\Avaliation;








class ProductsController extends Controller
{
    public function index(){
        $Enderecos = Endereco::all();
        $lat = 0;
        $long = 0;
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
        
        
        
        if($User && $User->AL_id != 3){
            foreach($loja as $loj){
                foreach($Enderecos as $Endereco){
                    if($loj->Endereco_id == $Endereco->id){
                        $lat = $Endereco->Latitude;
                        $long = $Endereco->Longitude;
                    }
                }
            }
            
        }
        

        $search = request('search');
        if($search){
            $premiumProducts = productsLoja::join('products','products.id','=','Product_id')
                                            ->join('users','products.user_id','=','users.id')
                                            ->join('lojas','lojas.id','=','Loja_id')
                                            ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                            ->where('lojas.Premium','=','1')
                                            ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                            products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                            lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id')
                                            ->orderBy('distancia', 'asc')
                                            ->take(2)
                                            ->where([['products.Name','like','%'.$search.'%']])
                                            ->get();

            if(count($premiumProducts) == 2){
                $limit = 6;
            }
            else if(count($premiumProducts)==1){
                $limit = 7;
            }
            else{
                $limit = 8;
            }
            $products = productsLoja::join('products','products.id','=','Product_id')
                                    ->join('users','products.user_id','=','users.id')
                                    ->join('lojas','lojas.id','=','Loja_id')
                                    ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                    ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                    products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                    lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id')
                                    ->orderBy('distancia', 'asc')
                                    ->take(6)
                                    ->where([['products.Name','like','%'.$search.'%']])
                                    ->get();
        }
        else
        {
            $premiumProducts = productsLoja::join('products','products.id','=','Product_id')
                                            ->join('users','products.user_id','=','users.id')
                                            ->join('lojas','lojas.id','=','Loja_id')
                                            ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                            ->where('lojas.Premium','=','1')
                                            ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                            products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                            lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id')
                                            ->inRandomOrder()
                                            ->take(2)
                                            ->get();
            if(count($premiumProducts) == 2){
                $limit = 6;
            }
            else if(count($premiumProducts)==1){
                $limit = 7;
            }
            else{
                $limit = 8;
            }
            

            $products = productsLoja::join('products','products.id','=','Product_id')
                                    ->join('users','products.user_id','=','users.id')
                                    ->join('lojas','lojas.id','=','Loja_id')
                                    ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                    ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                    products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                    lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id')
                                    ->inRandomOrder()
                                    ->take($limit)
                                    ->get();
        }


        return view('welcome',['products'=>$products,'search' => $search,'User'=>$User,'premiumProducts'=>$premiumProducts,'count'=>false]);
        
       
        
    }
    public function create(){
        $User = auth()->user();
        $categories = Category::all();
        return view('products.create',['User'=>$User,'categories'=>$categories]);
    }
    public function copyProduct(){
        
        $user = auth()->user();
        $lojas = Loja::where('user_id','=',$user->id)->get();
        foreach($lojas as $loja){
            $myproducts = productsLoja::where('Loja_id','=',$loja->id)->get();
            break;
        }
        $search = request('search');
        if($search){
            $products = Product::where([
                ['name','like','%'.$search.'%']
            ])
            ->join('users','products.user_id','=','users.id')
            ->where('users.AL_id','=',3)
            ->select('users.id as id_U','products.id as id','Name','Image','User_id')
            ->get();
        }
        else{
            $products = Product::join('users','products.user_id','=','users.id')
                                ->where('users.AL_id','=',3)
                                ->select('users.id as id_U','products.id as id','Name','Image','User_id')
                                ->get();
        }
        return view('products.copyProduct',['products'=>$products,'search' => $search,'myproducts'=>$myproducts,'count'=>false]);
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

        $idade = '';
        $pet = '';
        $porte = '';
        $apresentação = '';

        isset($request->idadeCombo) ? $idade = "Idade: ".$request->idadeCombo : null;
        isset($request->petCombo) ? $pet = "Pet: ".$request->petCombo : null;
        isset($request->porteCombo) ? $porte = "Porte: ".$request->porteCombo : null;
        isset($request->Apresentacaoinput) ? $apresentação = "Apresentação: ".$request->Apresentacaoinput : null;




        $inputs = array($idade,$pet,$porte,$apresentação);
        

        $product = new Product;

        $product->Name = $request->Name;
        $product->Description = implode('<!i!i>',$inputs);
        $product->category_id=$request->category;
        
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
    public function show($id,$prod = 'false'){
        $user = auth()->user();
        $Enderecos = Endereco::all();
        if($prod != 'false' && $user->AL_id != 1)
        {
            $product = Product::findOrFail($id);
            $description = explode('<!i!i>',$product->Description);
            return view('products.show',['product'=> $product,'Enderecos'=>$Enderecos,'desciption'=>$description,'user'=>$user,'prod'=>$prod]);

        }
        else{
            $products = productsLoja::join('products','products.id','=','Product_id')
                                    ->join('users','products.user_id','=','users.id')
                                    ->join('lojas','lojas.id','=','Loja_id')
                                    ->join('categories','categories.id','=','products.category_id')
                                    ->select('products.id as id_P','products.Name','products.Image','products.Description',
                                    'products_lojas.id','categories.name',
                                    'lojas.id as id_Loja','lojas.user_id','lojas.Endereco_id')
                                    ->get();
            foreach($products as $product){
                if($product->id == $id){
                    $avaliations = Avaliation::where('Loja_id','=',$product->id_Loja)->get();
                    $sum=0;
                    foreach($avaliations as $avaliation){
                        $sum = $sum + $avaliation->Qntd;
                    }
                    if($sum >0){
                        $sum = $sum/count($avaliations);
                    }
                    else{
                        $sum = 0;
                    }
                    $description = explode('<!i!i>',$product->Description);
                    return view('products.show',['product'=> $product,'Enderecos'=>$Enderecos,'desciption'=>$description,'user'=>$user,'sum'=>$sum,'prod'=>$prod]);
                }
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

        if($user->AL_id ==2){
            $products = productsLoja::join('products','products.id','=','Product_id')
                                ->join('users','products.user_id','=','users.id')
                                ->join('lojas','lojas.id','=','Loja_id')
                                ->join('categories','categories.id','=','products.category_id')
                                ->where('lojas.id','=',$Loja->id)
                                ->select('products.id as id_P','products.Name','products.Image','products.Description',
                                'products_lojas.id','categories.name',
                                'lojas.id as id_Loja','lojas.user_id','lojas.Endereco_id')
                                ->get();
        }
        else if($user->AL_id ==1){
            $products = null;
        }
        else if($user->AL_id ==3){
            $products = Product::all();
        }
        else{
            $products = null;
        }
        $categories = Category::all();
       
        return view('products.dashboard',['products' =>$products,'user'=>$user,'Enderecos'=>$Enderecos,'Loja'=>$Loja,
                    'categories'=>$categories]);
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
