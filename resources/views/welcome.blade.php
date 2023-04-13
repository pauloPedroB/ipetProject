@extends('layouts.main')
@section('title','PRODUTOS')
@section('content')
@auth
    <p>oiiiiiiiiiiiiiii {{$loja}}</p>
    @foreach($Enderecos as $Endereco)
        @if($Endereco->id==$User->Endereco_id)
            @php
                $latUser = $Endereco->Latitude;
                $longUser = $Endereco->Longitude;
            @endphp
        @endif
    @endforeach
@endauth

<div id="search-container" class="ol-md-12">
    <h1>Busque um Produto</h1>
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
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item ou Loja...">
    </form>
</div>
<div id="products-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{$search}}</h2>
    @else
        <h2>Produtos/Comércios</h2>
    @endif
    <p class="subtitle">Mais próximos de você</p>
    <div id="cards-container" class="row">
        @foreach ($products as $product)
            
                    <div class="card col-md-3">
                        <img src="/img/products/{{$product->Image}}" alt="{{$product->name}}">
                        <div class="card-body">
                            <p class="card-date">19/03/2023</p>
                            <h5 class="card-title">{{$product->Name}}</h5>
                            <h6 class="card-value">R$ {{$product->Value}}</h6>
                            <p class="card-distance">
                                @auth
                                    @foreach($Enderecos as $Endereco)
                                        @if($Endereco->id==$product->Endereco_id)
                                            @php
                                                $Endereco->Latitude = deg2rad($Endereco->Latitude);
                                                $Endereco->Longitude = deg2rad($Endereco->Longitude);
                                                
                                                $dlon = $Endereco->Longitude - deg2rad($longUser);
                                                $dlat = $Endereco->Latitude - deg2rad($latUser);

                                                $a = sin($dlat/2)**2+cos(deg2rad($latUser))*cos($Endereco->Latitude)*sin($dlon/2)**2;
                                                $c = 2 * asin(sqrt($a));
                                                $r = 6371;
                                                $d = $c*$r;
                                                
                                            @endphp
                                            @if($Endereco->id == $User->Endereco_id)
                                                Distância: 0 KM
                                            @else
                                                Distância: {{floatval(number_format($d,1))}} KM
                                            @endif
                                        @endif
                                    @endforeach
                                @endauth
                            </p>
                            <a href="/produto/{{$product->id}}" class="btn btn-primary">Saiba Mais...</a>
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

  
