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
use DateTime;







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
        $category = request('Category');
        if($category == 'all'){
                $category = "";
            }
        if($search){
            
            $premiumProducts = productsLoja::join('products','products.id','=','Product_id')
                                            ->join('users','products.user_id','=','users.id')
                                            ->join('lojas','lojas.id','=','Loja_id')
                                            ->join('categories','categories.id','=','products.category_id')
                                            ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                            ->where('lojas.Premium','=','1')
                                            ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                            products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                            lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id, products_lojas.created_at as criation')
                                            ->orderBy('distancia', 'asc')
                                            ->take(5)
                                            ->where([['products.Name','like','%'.$search.'%']])
                                            ->where('categories.name','like','%'.$category.'%')
                                            ->get();

            $products = productsLoja::join('products','products.id','=','Product_id')
                                    ->join('users','products.user_id','=','users.id')
                                    ->join('lojas','lojas.id','=','Loja_id')
                                    ->join('enderecos','enderecos.id','=','lojas.Endereco_id')
                                    ->join('categories','categories.id','=','products.category_id')
                                    ->selectRaw('products.id as id_P, products.Name, products.Image, products.Description,
                                    products_lojas.id, enderecos.id as End_id, (6371 * acos(cos(radians('.$lat.')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians('.$long.')) + sin(radians('.$lat.')) * sin(radians(Latitude)))) AS distancia,
                                    lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id,products_lojas.created_at as criation')
                                    ->orderBy('distancia', 'asc')
                                    ->take(20)
                                    ->where([['products.Name','like','%'.$search.'%']])
                                    ->where([['categories.name','like','%'.$category.'%']])
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
                                            lojas.id as id_Loja, lojas.user_id, lojas.Endereco_id,products_lojas.created_at as criation')
                                            ->inRandomOrder()
                                            ->take(10)
                                            ->get();
            $products = null;
        }
        $categories = Category::all();

      
        return view('welcome',['products'=>$products,'search' => $search,'User'=>$User,'premiumProducts'=>$premiumProducts,'count'=>false,'categories'=>$categories,'lat'=>$lat,'long'=>$long]);
        
       
        
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
        $category = request('Category');
         if($category == 'all'){
                $category = "";
            }
        if($search){
           
            $products = Product::where([['products.Name','like','%'.$search.'%']])
            ->join('users','products.user_id','=','users.id')
            ->join('categories','categories.id','=','products.category_id')
            ->where('users.AL_id','=',3)
            ->where([['categories.name','like','%'.$category.'%']])
            ->select('users.id as id_U','products.id as id','products.Name','Image','User_id')

            ->get();
        }
        else{
            $products = Product::join('users','products.user_id','=','users.id')
                                ->join('categories','categories.id','=','products.category_id')
                                ->where('users.AL_id','=',3)
                                ->where([['categories.name','like','%'.$category.'%']])
                                ->select('users.id as id_U','products.id as id','products.Name','Image','User_id')
                                ->get();
        }
        $categories = Category::all();
        return view('products.copyProduct',['categories'=>$categories,'products'=>$products,'search' => $search,'myproducts'=>$myproducts,'count'=>false,'id'=>0]);
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
        $newProduct->created_at = new DateTime();
        
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
        
        if($prod != 'false' && $user)
        {
            if($user->AL_id !=1){
                $Loja = Loja::where([['user_id','=',$user->id]])->first();
            
                $product = Product::findOrFail($id);
                $description = explode('<!i!i>',$product->Description);
                $my = false;
                $myId = 0;
                if($user->AL_id == 2)
                {
                    $myproducts = productsLoja::where('Loja_id','=',$Loja->id)->get();
                    foreach($myproducts as $myproduct){
                        if($myproduct->Product_id == $product->id){
                            $myId = $myproduct->id;
                            $my = true;
                        }
                    }
                }
            

                return view('products.show',['product'=> $product,'Enderecos'=>$Enderecos,'desciption'=>$description,'user'=>$user,'prod'=>$prod,'my'=>$my,'myId'=>$myId]);

            }
            
        }
        else{
            $products = productsLoja::join('products','products.id','=','Product_id')
                                    ->join('users','products.user_id','=','users.id')
                                    ->join('lojas','lojas.id','=','Loja_id')
                                    ->join('categories','categories.id','=','products.category_id')
                                    ->select('products.id as id_P','products.Name','products.Image','products.Description',
                                    'products_lojas.id','categories.name',
                                    'lojas.id as id_Loja','lojas.user_id','lojas.Endereco_id','lojas.Razao','lojas.Nome','lojas.Telefone','lojas.Celular')
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
                    return view('products.show',['product'=> $product,'Enderecos'=>$Enderecos,'desciption'=>$description,'user'=>$user,'sum'=>$sum,'prod'=>$prod,'id'=>$id]);
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
        //$UserEndereco = Product::findOrFail($Loja->Endereco_id);
        
        return view('products.dashboard',['products' =>$products,'user'=>$user,'Enderecos'=>$Enderecos,'Loja'=>$Loja,
                    'categories'=>$categories]);
    }
    public function destroy($id, Request $request){
        $user = auth()->user();
        if($user->AL_id != 3){
            productsLoja::findOrFail($id)->delete();
        }
        else{
            Product::findOrFail($id)->delete();
        }
        if($request->ond)
        {
            return redirect('/produto/disponiveis')->with('msg','Produto adicionado com sucesso!');
        }
        return redirect('/dashboard')->with('msg','Produto excluído com sucesso!');
    }
    public function edit($id){
        $product=Product::findOrFail($id);
        $User = auth()->user();
        $categories = Category::all();
        $description = explode('<!i!i>',$product->Description);
        return view('products.edit',['product' => $product,'User'=>$User,'categories'=>$categories,'description'=>$description]);
    }
    public function update(Request $request){
        $idade = '';
        $pet = '';
        $porte = '';
        $apresentação = '';

        isset($request->idadeCombo) ? $idade = "Idade: ".$request->idadeCombo : null;
        isset($request->petCombo) ? $pet = "Pet: ".$request->petCombo : null;
        isset($request->porteCombo) ? $porte = "Porte: ".$request->porteCombo : null;
        isset($request->Apresentacaoinput) ? $apresentação = "Apresentação: ".$request->Apresentacaoinput : null;




        $inputs = array($idade,$pet,$porte,$apresentação);
        
        $product=Product::findOrFail($request->id);
        
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

        return redirect('/dashboard')->with('msg','Produto Editado com sucesso!');
    }
}
