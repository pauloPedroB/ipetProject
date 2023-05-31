<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">

    <!-- font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="/js/funcoes.js"></script>

</head>

<body onload="preCarregamento();">
    <main>


        <div class="pre-carregamento">
            <img src="/img/loogoIpet-ret.png" alt="" class="efeito-carregamento">
        </div>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary  text-end">
                <div class="container-fluid">
                    <a href="" class="navbar-brand">
                        <img src="/img/loogoIpet-ret.png" alt="">
                    </a>
                    <a class="navbar-brand" href="#">Ipet</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown justify-content-end">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Categorias
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Alimentação</a></li>
                                    <li><a class="dropdown-item" href="#">Brinquedos</a></li>
                                    <li><a class="dropdown-item" href="#">Cuidados</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Produtos</a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a href="/produto/adicionar" class="nav-link">Adicionar Produtos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">Meus Produtos</a>
                                </li>
                                <li class="nav-item">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <input type="submit"
                                            onclick="product.preventDefault();
                                this.closest('form').submit();"
                                            class="btnClose" value="Sair">
                                    </form>
                                </li>
                            @endauth
                            @guest

                                <li class="nav-item">
                                    <a class="nav-link" href="/login">Entrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/usuario/Tipo_de_Acesso">Cadastrar</a>
                                </li>

                            @endguest
                        </ul>

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
        <div class="footer-content">
            <h3>IPET DEVELOPMENT &copy; 2023</h3>
            <ul class="contacts">
                <li><a href="#"><i class="fa-brands fa-whatsapp" ></i></a></li>
                <li><a href="https://instagram.com/_ipet2023?igshid=OGQ5ZDc2ODk2ZA== "target="_blanck" ><i class="fa-brands fa-instagram" ></i></li>
                <li><a href="https://twitter.com/Ipet2023" target="_blanck" ><i class="fa-brands fa-twitter" ></i></li>
            </ul>
        </div>
    </footer>
    </main>
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>
</body>

</html>
