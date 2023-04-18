@extends('layouts.main')
@section('title','PRODUTOS')
@section('content')


<div id="search-container" class="ol-md-12">
    <h1>Adicione um Produto à sua loja</h1>
    <form action="/" method="GET">
        <p> Pesquisar por: 
            <select name="Category" id="">
                <option value="">Todos</option>
                <option value="">Rações</option>
                <option value="">Remédios</option>
                <option value="">Acessórios</option>
            </select>
            Pesquisar por ordem de: 
            <select name="orderBy" id="">
                <option value="">Distância</option>
                <option value="">Preço</option>
                <option value="">Avaliação</option>
            </select>
        </p>
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item...">
    </form>
</div>
<div id="products-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{$search}}</h2>
    @else
        <h2>Produtos</h2>
    @endif
    <div id="cards-container" class="row">
        @foreach ($products as $product)
                    <div class="card col-md-3">
                        <img src="/img/products/{{$product->Image}}" alt="{{$product->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->Name}}</h5>
                            <a href="/produto/copiar/{{$product->id}}" class="btn btn-primary">Adicionar à sua loja</a>
                        </div>
                    </div>
        @endforeach
        @if(count($products)==0)
            <p>Não foi possível encontrar nenhum produto com {{$search}}! <a href="/">Ver Todos!</a></p>
        @elseif(count($products)==0)
            <p>Não há eventos disponíveis</p>
        @endif
    </div>
</div>
@endsection

  
