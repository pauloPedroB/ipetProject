@extends('layouts.main')
@section('title','Produto')
@section('content')
<div class="container-fluid" style="width: max-content;margin: auto" id='show-main'>
    <div class="row" id="products-information">

        <div id="image-container" class="col-md-6 m-0 p-0">
            <h5 class="fw-bold">{{$product->Name}}</h5>
            <img src="/img/products/{{$product->Image}}" class="img-fluid w-50" alt="{{$product->Name}}">

            <div class="col-md-12 m-5" id="description-container">
                <h3>Descrição: </h3>
                @foreach($desciption as $des)
                @if($des!=null && $des!='<!i!i>')
                    @if (strpos($des, 'Apresentação: ') !== false)
                    @php
                    $des = explode('; ',$des);
                    @endphp
                    <br>
                    @foreach ($des as $d)
                    <p class="product-Description">{{$d}}</p>
                    @endforeach
                    @else
                    <p class="product-Description">{{$des}}</p>

                    @endif
                    @endif
                    @endforeach
            </div>



        </div>
        <div id="info-container" class="col-md-6 align-itens-start" style="font-size: 24px">
            <h3>{{$product->Nome}} -
                @foreach($Enderecos as $Endereco)
                @if($Endereco->id==$product->Endereco_id)
                {{$Endereco->Bairro}}
                @endif
                @endforeach
            </h3>


            @if($prod == 'false')

            <div class="stars align-center d-flex flex-row mb-2">
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

            <div id="data-user-productShow" class="my-2 p-0">



                @foreach($Enderecos as $Endereco)
                @if($Endereco->id==$product->Endereco_id)
                <p>{{$Endereco->Logradouro}}, {{$Endereco->Numero}}</p>
                <p>{{$Endereco->Bairro}} - {{$Endereco->Cidade}}</p>
                <p>Tel: {{$product->Telefone}} - Cel: {{$product->Celular}}</p>
                <p>CEP: {{$Endereco->CEP}}</p>

                <button class="btn btn-success my-2"
                    onclick="initMap({{$Endereco->Latitude}}, {{$Endereco->Longitude}});">Localizar
                    Loja</button>
                <div id="mapa" style="width:30vw ;height:20vw;"></div>
                @break
                @endif
                @endforeach
            </div>
        </div>
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