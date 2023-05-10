<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">

    <!-- font-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="/js/funcoes.js"></script>
    <script src="/js/cep.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4"></script>
    <script>
        function initMap(lat1, long1) {
            var minhaLocalizacao = {
                lat: lat1,
                lng: long1
            };

            var mapa = new google.maps.Map(
                document.getElementById('mapa'), {
                    zoom: 18,
                    center: minhaLocalizacao
                });
            var marcador = new google.maps.Marker({
                position: minhaLocalizacao,
                map: mapa
            });

        }
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md container">
            <div class="container">
                <div>
                    <a href="" class="navbar-brand">
                        <img class="img-fluid" src="/img/LogoIpet.png" alt="" id="nav-logo">
                    </a>
                </div>
                <div id="input-container">
                    <form action="/" method="GET">
                        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar Item ou Loja...">
                        


                    </form>
                </div>
                <div>
                    <button id="btnToogle" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-start w-50 container" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">

                            <h5 class="offcanvas-title" id="navbarNavLabel">iPet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <hr>
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                @auth
                                <li class="nav-item">
                                    <a id="nav-link">Bem
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
                </div>
        </nav>

    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if (session('msg'))
                <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <p>IPET DEVELOPMENT &copy; 2023</p>
    </footer>
    <script src="https://kit.fontawesome.com/0772530246.js" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
