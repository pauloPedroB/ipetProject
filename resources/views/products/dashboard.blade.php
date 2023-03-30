@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-products-container">
    @if(count($products)>0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Peso</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td><a href="/events/{{$product->id}}">{{$product->Name}}</a></td>
                        <td>{{$product->Value}}</td>
                        <td>
                            <a href="#" class="btn btn-info edit-btn">Editar</a>
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
    @else
        <p>Você ainda não tem produtos cadastrados, <a href="/products/create">adicionar produto</a></p>
    @endif

</div>
@endsection