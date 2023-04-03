<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">

    <!-- font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="/js/funcoes.js"></script>
    <script src="/js/cep.js" defer></script>
</head>
<body onload="preCarregamento();">
    <main>

    
        <div class="pre-carregamento" id="pre-carregamento">
            <img src="/img/logo.png" alt="" class="efeito-carregamento">
        </div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="" class="navbar-brand">
                        <img src="/img/logo.png" alt="">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Produtos</a>
                        </li>
                        @auth
                        <li>
                            <a href="/Endereco/" class="nav-link">
                                Endereço
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/produto/adicionar" class="nav-link">Adicionar Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Meus Produtos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <input type="submit" onclick="product.preventDefault();
                                this.closest('form').submit();" class="btnClose" value="Sair">
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
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                        <p class="msg">{{session('msg')}}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p>IPET DEVELOPMENT &copy; 2023</p>
        </footer>
    </main>
    <script src="/js/app.js"></script>
    
</body>
</html>
    

  
