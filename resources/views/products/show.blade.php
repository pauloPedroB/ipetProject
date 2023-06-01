@extends('layouts.main')
@section('title','{{$product->Name}}')
@section('content')
<div class="" id='show-main'>
    <div class="row" id="products-information">
        <h1>{{$product->Name}}</h1>
        <div id="image-container" class="col-md-6">
            <img src="/img/products/{{$product->Image}}" class="img-fluid" alt="{{$product->Name}}">
        </div>
        <div id="info-container" class="col-md-6">

            <p class="product-Category">{{$product->name}}</p>
            <br>

            @if($prod == 'false')
            <p>Avaliação da Loja:</p>

            <div class="stars">

                @if($sum>=0.4)
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                @else
                <a chref="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                @endif
                @if($sum>=1.4)
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                @else
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                @endif
                @if($sum>=2.4)
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                @else
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                @endif
                @if($sum>=3.4)
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                @else
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                @endif
                @if($sum>=4.4)
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                @else
                <a href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                @endif
                @endif
            </div>


            @if($prod == 'false')

            @else
            @if($user->AL_id == 2)
            @if($my == false)
            <form action="/produto/copiar/{{$product->id}}">
                <button id="maps" type="submit" style="background-color: chartreuse; border-color: chartreuse">Adicionar
                    a minha loja</button>
            </form>
            @else
            <form action="/produtos/{{$myId}}" method="POST">
                @csrf
                @method('DELETE')
                <button id="maps" type="submit" style="background-color: red; border-color: red">Remover
                    produto</button>
            </form>
            @endif
            @endif
            @endif


            <br>
            <div class="data-user-product">
                <h1>Dados da Loja</h1>
                <p> <span class="text-endereco">Telefone:</span>{{$product->Telefone}}</p>
                <p> <span class="text-endereco">Celular:</span>{{$product->Celular}}</p>


                @foreach($Enderecos as $Endereco)
                @if($Endereco->id==$product->Endereco_id)
                <p> <span class="text-endereco">CEP: </span>{{$Endereco->CEP}}</p>
                <p> <span class="text-endereco">Rua: </span> {{$Endereco->Logradouro}}</p>
                <p> <span class="text-endereco">Número: </span> {{$Endereco->Numero}}</p>
                <p> <span class="text-endereco">Bairro: </span> {{$Endereco->Bairro}}</p>
                <p> <span class="text-endereco">Cidade: </span> {{$Endereco->Cidade}}</p>
            </div>
            <button id="maps" onclick="initMap({{$Endereco->Latitude}}, {{$Endereco->Longitude}});">Localizar
                Loja</button>
            <div id="mapa" style="width:400px;height:250px;"></div>
            @break
            @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-12" id="description-container">
        <h3>Descrição: </h3>
        @foreach($desciption as $des)
        @if($des!=null && $des!='<!i!i>')
            <p class="product-Description">{{$des}}</p>
            @endif
            @endforeach
    </div>
    @auth
    @if($user->AL_id==1)
    <div class="col-md-12" id="Avaliation-container">
        <h3>Avalie sua experiência:</h3>
        <div class="stars">
            <a href="javascript:void(0)" onclick="Avaliar(1)"><img class="stars-img" src="/img/star0.png" id="s1"></a>
            <a href="javascript:void(0)" onclick="Avaliar(2)"><img class="stars-img" src="/img/star0.png" id="s2"></a>
            <a href="javascript:void(0)" onclick="Avaliar(3)"><img class="stars-img" src="/img/star0.png" id="s3"></a>
            <a href="javascript:void(0)" onclick="Avaliar(4)"><img class="stars-img" src="/img/star0.png" id="s4"></a>
            <a href="javascript:void(0)" onclick="Avaliar(5)"><img class="stars-img" src="/img/star0.png" id="s5"></a>
        </div>
        <form action="/avaliar" method="POST">
            @csrf
            <input type="hidden" name="product" id="product" value="{{$id}}">
            <input type="hidden" name="value" id="rating" value="0">
            <input type="hidden" name="loja" value="{{$product->id_Loja}}">
            <label for="avaliacao">Elogio, sugestão ou reclamação:</label>
            <input type="text" name="avaliacao" class="form-control" id="avaliacao">
            <input type="submit" class="btn btn-primary">
        </form>

    </div>
    @endif
    @endauth
</div>
</div>
@endsection