@extends('layouts.main')
@section('title','PRODUTOS')
@section('content')


<div id="search-container" class="ol-md-12">
    <h1>Busque um Produto</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item ou Loja...">
    </form>
</div>
<div id="products-container" class="col-md-12">
    <h2>Produtos/Comércios</h2>
    <p class="subtitle">Mais próximos de você</p>
    <div id="cards-container" class="row">
        @foreach ($products as $product)
            <div class="card col-md-3">
                <img src="/img/3469431.jpg" alt="{{$product->name}}">
                <div class="card-body">
                    <p class="card-date">19/03/2023</p>
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h6 class="card-value">R$ {{$product->preco}}</h6>
                    <p class="card-distance">Há 200m de distância</p>
                    <a href="" class="btn btn-primary">Localizar</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

  
