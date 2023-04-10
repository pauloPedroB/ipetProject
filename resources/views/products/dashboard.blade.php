@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Dados</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-name-container">
    <h3>{{$user->name}}</h3>
</div>
@if($user->Endereco_id == null && $user->AL_id !=3)
    <div class="col-md-10 offset-md-1 dashboard-endereco-container">
        <p>Registre o seu <a href="/Endereco/">ENDEREÇO</a></p>
    </div>
@else
    @foreach($Enderecos as $Endereco)
        @if($Endereco->id == $user->Endereco_id)
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
    <div class="col-md-10 offset-md-1 dashboard-products-container">
        @if(count($products)>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td scope="row">{{$loop->index+1}}</td>
                            <td><a href="/produto/{{$product->id}}">{{$product->Name}}</a></td>
                            <td>{{$product->Value}}</td>
                            <td>
                                <a href="/produtos/edit/{{$product->id}}" class="btn btn-info edit-btn">Editar</a>
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
            <a href="/produto/disponiveis">adicionar produto</a>
        @else
            <p>Você ainda não tem produtos cadastrados, <a href="/produto/disponiveis">adicionar produto</a></p>
        @endif
    </div>
@endif


@endsection