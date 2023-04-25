@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Dados</h1>
</div>


@if($user->AL_id !=3)
    @if($Loja->Endereco_id == null)
        <div class="col-md-10 offset-md-1 dashboard-endereco-container">
            <p>Registre o seu <a href="/Endereco/">ENDEREÇO</a></p>
        </div>
    @else
        @foreach($Enderecos as $Endereco)
            @if($Endereco->id == $Loja->Endereco_id)
                <div class="col-md-10 offset-md-1 dashboard-endereco-container">
                    <p>CEP: {{$Endereco->CEP}}</p>
                    <p>Rua: {{$Endereco->Logradouro}}</p>
                    <p>Número: {{$Endereco->Numero}}</p>
                    <p>Bairro: {{$Endereco->Bairro}}</p>
                    <p>Cidade: {{$Endereco->Cidade}}</p>
                    <p>Edite o seu <a href="/Endereco/">ENDEREÇO</a></p>
                </div>
                @break
            @endif
        @endforeach
    @endif

@endif
@if($user->AL_id == null)
    <h1>{{$user->AL_id}} é nulo</h1>
@endif
@if($user->AL_id !=1)
    <div class="col-md-10 offset-md-1 dashboard-products-container">
        @if($user->AL_id == 3)
            <h1>Categorias</h1>
            <table class="table">
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
                            <td>
                                <form action="/categoria/{{$category->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/categoria/adicionar">adicionar categoria</a>
        @endif
        <h1>Produtos</h1>
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
                            <td><a href="/produto/{{$product->id}}">{{$product->Name}}</a></td>
                            <td>
                                @if($user->AL_id ==3)
                                <!-- <a href="/produtos/edit/{{$product->id}}" class="btn btn-info edit-btn">Editar</a> -->
                                @endif
                                <form action="/produtos/{{$product->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($user->AL_id !=3)
                <a href="/produto/disponiveis">adicionar produto</a>
            @else
            
                <a href="/produto/adicionar">adicionar produto</a>
            @endif
        @else
            @if($user->AL_id !=3)
                <p>Você ainda não tem produtos cadastrados, <a href="/produto/disponiveis">adicionar produto</a></p>
            @else
            <p>Você ainda não tem produtos cadastrados, <a href="/produto/adicionar">adicionar produto</a></p>
            @endif
        @endif
    </div>
@endif

@endsection