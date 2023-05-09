@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="dashboard-title-container">
    <h1>Meus Dados</h1>
</div>


{{-- dados do endereço --}}

@if($user->AL_id !=3)
    @if($Loja->Endereco_id == null)
        <div class="dashboard-endereco-container">
            <p>Registre o seu <a href="/Endereco/">ENDEREÇO</a></p>
        </div>
    @else
        @foreach($Enderecos as $Endereco)
            @if($Endereco->id == $Loja->Endereco_id)
                <div id="data-user-container" class="col dashboard-endereco-container">
                    <h1>Endereço:</h1>
                    <p>CEP: {{$Endereco->CEP}}</p>
                    <p>Rua: {{$Endereco->Logradouro}}</p>
                    <p>Número: {{$Endereco->Numero}}</p>
                    <p>Bairro: {{$Endereco->Bairro}}</p>
                    <p>Cidade: {{$Endereco->Cidade}}</p>
                    <p>Edite o seu <a href="/Endereco/">ENDEREÇO</a></p>

                    @if($user->AL_id == 2)
                        <p><a href="/pacote">Pacote</a></p>
                    @endif
                </div>
                @break
            @endif
        @endforeach
    @endif

@endif

{{-- categorias --}}

@if($user->AL_id !=1)
    <div id="products-container" class="dashboard-products-container">
        @if($user->AL_id == 3)
            <h1 class="text-uppercase">Categorias</h1>
            <table id="table-categories" class="table">
                <thead>
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td scope="row">{{$loop->index+1}}</td>
                            <td><p>{{$category->name}}</p></td>
                            <td>{{$category->Description}}</td>
                            <td class="d-flex justify-content-around">
                                @if($user->AL_id ==3)
                                <a href="/categoria/{{$category->id}}" class="btn btn-outline-warning  btn-lg"><span class="material-symbols-outlined align-middle ">edit</span></a>
                               @endif
                                <form action="/categoria/{{$category->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-lg "><span class="material-symbols-outlined align-middle ">delete</span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <a class="add-categories" href="/categoria/adicionar">Adicionar Categoria</a>
            </table>
        @endif

{{-- produtos --}} 
        <h1 id="title-products" class="text-uppercase">Produtos</h1>
        @if($products != null)
            <table id="table-produts" class="table">
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
                            <td class="d-flex justify-content-around">
                                @if($user->AL_id ==3)
                                 <a href="/produtos/edit/{{$product->id}}" class="btn btn-outline-warning w-25  p-1"><span class="material-symbols-outlined align-middle">edit</span></a>
                                @endif
                                <form class="w-25 p-1" action="/produtos/{{$product->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100 p-3"><span class="material-symbols-outlined align-middle ">delete</span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($user->AL_id !=3)
                <a class="add-categories" href="/produto/disponiveis">Adicionar Produto</a>
            @else
            
                <a class="add-categories" href="/produto/adicionar" >Adicionar Produto</a>
            @endif
        @else
            @if($user->AL_id !=3)
                <p>Você ainda não tem produtos cadastrados, <a class="add-categories" href="/produto/disponiveis">adicionar produto</a></p>
            @else
            <p>Você ainda não tem produtos cadastrados, <a  class="add-categories" href="/produto/adicionar">adicionar produto</a></p>
            @endif
        @endif
    </div>
@endif


@endsection