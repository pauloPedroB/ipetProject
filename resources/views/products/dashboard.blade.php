@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="dashboard-title-container">
    <h1>Meus Dados</h1>
</div>

<div class="dashboard-content">
    {{-- dados do endereço --}}

    @if($user->AL_id !=3)
     
            @foreach($Enderecos as $Endereco)
                @if($Endereco->id == $Loja->Endereco_id)
                    <div id="data-user-container" class="col dashboard-endereco-container container-fluid m-5 p-3">
                        <div class="d-flex flex-column flex-md-row align-items-baseline">
                            <div class="d-flex flex-column m-5">
                                <h1>Meus Dados</h1>
                                @if($user->AL_id == 2)
                                    <p> <span class="text-endereco">CNPJ: </span>{{$Loja->CNPJ}}</p>
                                    <p> <span class="text-endereco">Razão social: </span>{{$Loja->Razao}}</p>
                                    <p> <span class="text-endereco">Nome fantasia: </span>{{$Loja->Nome}}</p>
                                    <p> <span class="text-endereco">Telefone: </span>{{$Loja->Telefone}}</p>
                                    <p> <span class="text-endereco">Celular: </span>{{$Loja->Celular}}</p>
                                @else
                                    <p> <span class="text-endereco">CPF: </span>{{$Loja->CPF}}</p>
                                    <p> <span class="text-endereco">Nome: </span>{{$Loja->Name}}</p>
                                    <p> <span class="text-endereco">Data de Nascimento: </span>{{date('d/m/Y', strtotime($Loja->DT))}}</p>
                                    <p> <span class="text-endereco">Telefone: </span>{{$Loja->Telefone}}</p>
                                    <p> <span class="text-endereco">Celular: </span>{{$Loja->Celular}}</p>
                                @endif
                            </div>
                            <div class="d-flex flex-column m-5">
                                <h1>Endereço</h1>
                                <p> <span class="text-endereco">CEP: </span>{{$Endereco->CEP}}</p>
                                <p> <span class="text-endereco">Rua: </span> {{$Endereco->Logradouro}}</p>
                                <p> <span class="text-endereco">Número: </span> {{$Endereco->Numero}}</p>
                                <p> <span class="text-endereco">Bairro: </span> {{$Endereco->Bairro}}</p>
                                <p> <span class="text-endereco">Cidade: </span> {{$Endereco->Cidade}}</p>
    
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row ">
                            <a href="/Editar/Loja/{{$Loja->id}}"><button class="m-2" id="btn-dasboard"type="button">Edite os seus dados</button></a>
    
                            @if($user->AL_id == 2)
                            <a href="/pacote"><button class="m-2" id="btn-dasboard" type="button">Pacote</button></a>
                            @endif
                        </div>
                    </div>
                    @break
                @endif
            @endforeach

    @endif

    {{-- categorias --}}

    @if($user->AL_id !=1)
        <div id="table-container">
            @if($user->AL_id == 3)
                <h1 class="text-uppercase">Categorias</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td scope="row">{{$loop->index+1}}</td>
                                <td><p>{{$category->name}}</p></td>
                                <td class="button-products" style="">
                                    @if($user->AL_id ==3)
                                    <a href="/categoria/{{$category->id}}" class="btn btn-warning  btn-lg " style="padding-left: 2rem; padding-right: 2rem;" ><span class="material-symbols-outlined align-middle ">edit</span></a>
                                @endif
                                    <form action="/categoria/{{$category->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-lg " style="width: 100%; padding-left: 2rem; padding-right: 2rem;"><span class="material-symbols-outlined align-middle ">delete</span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <a class="add-categories btn btn-outline-success" href="/categoria/adicionar">Adicionar Categoria</a>
                </table>
            @endif

    {{-- produtos --}} 
            <h1 class="text-uppercase">Produtos</h1>
            @if($products != null)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td scope="row">{{$loop->index+1}}</td>
                                @if($user->AL_id ==2)
                                    <td><a href="/produto/{{$product->id}}">{{$product->Name}}</a></td>
                                @else
                                    <td><a href="/produto/{{$product->id}}/true">{{$product->Name}}</a></td>
                                @endif
                                <td class="button-products" style="display: flex; flex-direction: row; justify-content:center; width: 100%; align-items:center; gap:15px;">
                                    @if($user->AL_id ==3)
                                    <a href="/produtos/edit/{{$product->id}}" class="btn btn-warning"  style="padding-left: 2rem; padding-right: 2rem;"><span class="material-symbols-outlined align-middle">edit</span></a>
                                    @endif
                                    <form class="" action="/produtos/{{$product->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="width: 100%; padding-left: 2rem; padding-right: 2rem;" ><span class="material-symbols-outlined align-middle ">delete</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($user->AL_id !=3)
                    <a class="add-categories btn btn-outline-success" href="/produto/disponiveis">Adicionar Produto</a>
                @else
                
                    <a class="add-categories btn btn-outline-success" href="/produto/adicionar" >Adicionar Produto</a>
                @endif
            @else
                @if($user->AL_id !=3)
                    <p>Você ainda não tem produtos cadastrados, <a class=" btn btn-outline-success" href="/produto/disponiveis">adicionar produto</a></p>
                @else
                <p>Você ainda não tem produtos cadastrados, <a  class="btn btn-outline-success" href="/produto/adicionar">adicionar produto</a></p>
                @endif
            @endif
        </div>
    @endif
</div>

@endsection
