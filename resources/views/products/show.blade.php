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


            <p>Avaliação da Loja:</p>
            @if($prod == 'false')
                @if($sum>=0.4)
                    <a href="javascript:void(0)"><img src="/img/star1.png"></a>
                @else
                    <a href="javascript:void(0)"><img src="/img/star0.png"></a>
                @endif
                @if($sum>=1.4)
                    <a href="javascript:void(0)"><img src="/img/star1.png"></a>
                @else
                    <a href="javascript:void(0)"><img src="/img/star0.png"></a>
                @endif
                @if($sum>=2.4)
                    <a href="javascript:void(0)"><img src="/img/star1.png"></a>
                @else
                    <a href="javascript:void(0)"><img src="/img/star0.png"></a>
                @endif
                @if($sum>=3.4)
                    <a href="javascript:void(0)"><img src="/img/star1.png"></a>
                @else
                    <a href="javascript:void(0)"><img src="/img/star0.png"></a>
                @endif
                @if($sum>=4.4)
                    <a href="javascript:void(0)"><img src="/img/star1.png"></a>
                @else
                    <a href="javascript:void(0)"><img src="/img/star0.png"></a>
                @endif
            @endif
            

            <br>
            @foreach($Enderecos as $Endereco)
                @if($Endereco->id==$product->Endereco_id)
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
                    <a href="javascript:void(0)" onclick="Avaliar(1)"><img src="/img/star0.png" id="s1"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(2)"><img src="/img/star0.png" id="s2"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(3)"><img src="/img/star0.png" id="s3"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(4)"><img src="/img/star0.png" id="s4"></a>
                    <a href="javascript:void(0)" onclick="Avaliar(5)"><img src="/img/star0.png" id="s5"></a>
                    <form action="/avaliar" method="POST">
                        @csrf
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