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
        @if (session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif
        {{-- fim --}}

    </header>

    
    <div id="products-container" class="col-md-12" >
        @if($search)
            <h2>Buscando por: {{$search}}</h2>
        @else
        <div class="container-title-loja">
            <h2>Produtos</h2>
            @endif
        </div>
        <div id="cards-container" class="row">
    
            @foreach ($products as $product)
    
                @php
                    $count = false;
                    $id = 0;
                    foreach($myproducts as $myproduct){
                            if($myproduct->Product_id == $product->id){
                                $count = true;
                                $id = $myproduct->id;
                                break;
                            }
                        }
                @endphp 
                        <div class="card col-sm-3">
                            <img class="img-fluid" src="/img/products/{{$product->Image}}" alt="{{$product->name}}">
                            <h5 class="card-title-loja">{{$product->Name}}</h5>
                            <div class="card-body">
                                <div class="card-button">
                                    @if($count == true)
                                    <form action="/produtos/{{$id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="ond" style="display: none" value="true">
                                        <button type="submit" class="btn btn-primary" style="background-color: chartreuse; border-color: chartreuse">Remover produto</button>
                                    </form>
                                    @else
                                        <a href="/produto/copiar/{{$product->id}}" class="btn btn-primary" id='adc{{$product->id}}'>Adicionar à sua loja</a>
                                    @endif
                                        <a href="/produto/{{$product->id}}/true" class="btn btn-primary">Visualizar Produto</a>
                                </div>
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
                <li><a href="https://instagram.com/_ipet2023?igshid=OGQ5ZDc2ODk2ZA== "target="_blanck" ><i class="fa-brands fa-instagram" ></i></li>
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

