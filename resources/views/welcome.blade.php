<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ipet</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="/js/funcoes.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4"></script>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a href="" class="navbar-brand">
                    <img class="img-fluid" src="/img/IPetLogo.png" alt="" id="nav-logo">
                </a>

                <button id="btnToogle" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link">Bem
                                Vindo,
                                {{stristr(Auth::user()->email,"@", true)}}.</a>
                        </li>
                        @endauth
                        <li>
                            <a href="/" class="nav-link">Produtos</a>
                        </li>
                        @auth

                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus Dados</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <input id="btnClose" type="submit"
                                    onclick="product.preventDefault(); this.closest('form').submit();" class="btnClose"
                                    value="Sair">
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item ou Loja...">
        </form>
    </header>


    <div id="carouselIpet" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" data-bs-interval="500">

            <div class="carousel-caption1">
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

            <div class="carousel-item active">
                <img src="/img/pet-supplies/6858348.jpg" class="img-fluid rounded-4 w-100
                " alt="...">

            </div>
            <div class="carousel-item">
                <img src="/img/pet-care/3828509.jpg" class="img-fluid rounded-4 w-100" alt="...">

            </div>
            <div class="carousel-item">
                <img src="/img/pet-cools/3906953.jpg" class="img-fluid rounded-4 w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIpet" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIpet" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div id="products-container" class="col-md-12">
        @if ($search)
        <h2>Buscando por: {{ $search }}</h2>
        @else
        <h2>Produtos/Comércios</h2>
        @endif
        <p class="subtitle">Mais próximos de você</p>
        <div id="cards-container" class="row">
            @foreach ($products as $product)
            <div class="card col-md-3">
                <img class="img-fluid" src="/img/products/{{ $product->Image }}" alt="{{ $product->name }}">
                <div class="card-body">
                    <p class="card-date">19/03/2023</p>
                    <h5 class="card-title">{{ $product->Name }}</h5>
                    <p class="card-distance">
                        @auth
                        @if($User->AL_id !=3)
                    <p>Distancia: {{floatval(number_format($product->distancia,1))}} KM</p>
                    @endif

                    @endauth
                    </p>
                    <a href="/produto/{{ $product->id }}" class="btn btn-primary">Saiba Mais...</a>
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
    <footer>
        <p>IPET DEVELOPMENT &copy; 2023</p>
    </footer>

    <script src="/js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>