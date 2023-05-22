<!DOCTYPE html>
<html lang="pt-BR">

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

        {{-- inicio --}}
            <nav class="navbar navbar-expand-lg container" >
                <div class="container container-header">
                    <div id="container-img">
                        <a href="" class="navbar-brand">
                            <img class="logo-icon" src="/img/LogoIpet.png" alt="" id="nav-logo">
                        </a>
                    </div>
                    <div class="form-control ">
                        <form class="d-flex flex-row" action="/produto/disponiveis" method="get">
                            <div class="me-5">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="search" name="search" 
                                placeholder= "Buscar Produto...">
                            </div>
                            <div class="ms-5">
                                <select name="Category" id="Category">
                                    <option value="all">Todos</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div>
                        <button id="btnToogle" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start w-50 container" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">

                                <h5 class="offcanvas-title" id="navbarNavLabel">iPet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body">
                                <hr>
                                <ul class="navbar-nav justify-content-end flex-grow-1">
                                    @auth
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="nav-link">Bem
                                            Vindo,
                                            {{stristr(Auth::user()->email,"@", true)}}.</a>
                                    </li>
                                    @endauth
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
                                            <input id="btnClose" type="submit"
                                                onclick="product.preventDefault(); this.closest('form').submit();"
                                                class="btnClose" value="Sair">
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
                    </div>
            </nav>
        </div>
        
        {{-- fim --}}

    </header>

    <div id="carouselIpet" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselIpet" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" data-bs-interval="500">
            <div class="carousel-item active ">
                <img src="/img/pet-supplies/6858348.jpg" class="img-fluid rounded-4 w-100 d-none d-sm-block ps-5 pe-5
                        " alt="...">
                <img src="/img/pet-supplies/6858348-cell.jpg" class="img-fluid w-100 h-screen d-block d-sm-none p-2 m-0
                                        " alt="...">

            </div>
            <div class="carousel-item">
                <img src="/img/pet-care/3828509.jpg" class="img-fluid rounded-4 w-100 d-none d-sm-block ps-5 pe-5"
                    alt="...">
                <img src="/img/pet-care/3828509-cell.jpg" class="img-fluid  w-100 d-block d-sm-none p-2 m-0" alt="...">

            </div>
            <div class="carousel-item">
                <img src="/img/pet-cools/3906953.jpg" class="img-fluid rounded-4 w-100 d-none d-sm-block ps-5 pe-5"
                    alt="...">
                <img src="/img/pet-cools/3906953-cell.jpg" class="img-fluid  w-100 d-block d-sm-none p-2 m-0" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev m-5" type="button" data-bs-target="#carouselIpet" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next m-5" type="button" data-bs-target="#carouselIpet" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div id="products-container" class="col-md-12" >
        @if($search)
            <h2>Buscando por: {{$search}}</h2>
        @else
            <h2>Produtos</h2>
        @endif
        <div id="cards-container" class="row">
    
            @foreach ($products as $product)
    
                @php
                    $count = false;
                    foreach($myproducts as $myproduct){
                            if($myproduct->Product_id == $product->id){
                                $count = true;
                                break;
                            }
                        }
                @endphp 
                        <div class="card col-md-3">
                            <img class="img-fluid" src="/img/products/{{$product->Image}}" alt="{{$product->name}}">
                            <h5 class="card-title">{{$product->Name}}</h5>
                            <div class="card-body">
                                @if($count == true)
                                <form action="/produtos/{{$product->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" style="background-color: chartreuse; border-color: chartreuse">Remover produto</button>
                                </form>
                                @else
                                    <a href="/produto/copiar/{{$product->id}}" class="btn btn-primary" id='adc{{$product->id}}'>Adicionar à sua loja</a>
                                @endif
                                <a href="/produto/{{$product->id}}/true" class="btn btn-primary">Visualizar Produto</a>
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
        <div class="footer-content">
            <h3>IPET DEVELOPMENT &copy; 2023</h3>
            <ul class="contacts">
                <li><a href="#"><i class="fa-brands fa-whatsapp" ></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram" ></i></li>
                <li><a href="#"><i class="fa-brands fa-twitter" ></i></li>
            </ul>
        </div>
    </footer>

    <script src="/js/app.js"></script>
     <script>
      const link = document.getElementById("nav-link");
      if (link.innerText.length > 20) {
        link.innerText = link.innerText.substring(0, 20)+"...";
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>
</body>

</html>

