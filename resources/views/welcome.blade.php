<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="/js/funcoes.js"></script>
    <script src="/js/cep.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4"></script>
    <script>
        function initMap(lat1,long1)
        {
            var minhaLocalizacao = {lat: lat1, lng: long1};
            var mapa = new google.maps.Map(
                document.getElementById('mapa'), {zoom: 18, center: minhaLocalizacao});
            var marcador = new google.maps.Marker({position: minhaLocalizacao, map: mapa});
        }

    </script>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a href="" class="navbar-brand">
                    <img src="/img/IPetLogo.png" alt="" id="nav-logo">
                </a>
                <a class="navbar-brand" href="#">iPET</a>
                <button id="btnToogle" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Produtos</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus Dados</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <input type="submit"
                                    onclick="product.preventDefault(); this.closest('form').submit();"
                                    class="btnClose" value="Sair">
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item ou Loja...">
    </header>
    @auth
    @foreach($Enderecos as $Endereco)
    @if($Endereco->id==$id_end)
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
                        @if($Endereco->id == $id_end)
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
