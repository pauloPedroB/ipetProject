@extends('layouts.main')
@section('title','{{$product->Name}}')
@section('content')
<div class="col-md-10 offset-md-1" id='show-main'>
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/products/{{$product->Image}}" class="img-fluid" alt="{{$product->Name}}">
        </div>
        <div id="info-container" class="col-md-6">

            <h1>{{$product->Name}}</h1>
            <p class="product-Category">{{$product->name}}</p>
            <br>

            @if($prod == 'false')
                <p>Avaliação da Loja:</p>

                <div class="stars">

                    @if($sum>=0.4)
                        <a href="javascript:void(0)"><img  class="stars-img" src="/img/star1.png"></a>
                    @else
                        <a chref="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                    @endif
                    @if($sum>=1.4)
                        <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                    @else
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                    @endif
                    @if($sum>=2.4)
                        <a href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                    @else
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                    @endif
                    @if($sum>=3.4)
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                    @else
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                    @endif
                    @if($sum>=4.4)
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star1.png"></a>
                    @else
                        <a  href="javascript:void(0)"><img class="stars-img" src="/img/star0.png"></a>
                    @endif
                </div>
            @else
                @if($user->AL_id == 2)
                    @if($my == false)
                        <form action="/produto/copiar/{{$product->id}}">
                            <button id="maps" type="submit" style="background-color: chartreuse; border-color: chartreuse">Adicionar a minha loja</button>
                        </form>
                    @else
                        <form action="/produtos/{{$myId}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="maps" type="submit" style="background-color: red; border-color: red">Remover produto</button>
                        </form>
                    @endif
                @endif
            @endif
            
                
            <br>
            
            @foreach($Enderecos as $Endereco)
                @if($Endereco->id==$product->Endereco_id)
                    <p class="product-Razao">{{$product->Razao}}</p>
                    <p class="product-Bairro">{{$Endereco->CEP}}</p>
                    <p class="product-Logradouro">{{$Endereco->Logradouro}}, Número: {{$Endereco->Numero}}</p>
                    <p class="product-Bairro">{{$Endereco->Bairro}}</p>
                    <p class="product-Cidade">{{$Endereco->Cidade}}</p>

                    <button id="maps" onclick="initMap({{$Endereco->Latitude}}, {{$Endereco->Longitude}});">Localizar Loja</button>
                    <div id="mapa" style="width:400px;height:250px;"></div>
                    @break
                @endif
            @endforeach



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
                    <a href="javascript:void(0)" onclick="Avaliar(1)"><img src="/img/star0.png" id="s1" style="width: 50px"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(2)"><img src="/img/star0.png" id="s2" style="width: 50px"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(3)"><img src="/img/star0.png" id="s3" style="width: 50px"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(4)"><img src="/img/star0.png" id="s4" style="width: 50px"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(5)"><img src="/img/star0.png" id="s5" style="width: 50px"></a>
                    <form action="/avaliar" method="POST">
                        @csrf
                        <input type="hidden" name="product" id="rating" value="{{$id}}">
                        <input type="hidden" name="value" id="rating" value="0">
                        <input type="hidden" name="loja" value="{{$product->id_Loja}}">
                        <label for="avaliacao">Elogio, sugestão ou reclamação:</label>
                        <input type="text" name="avaliacao" class="form-control">
                        <input type="submit" class="btn btn-primary">
                    </form>
                    
                </div>
            @endif
        @endauth    
    </div>
</div>
@endsection
