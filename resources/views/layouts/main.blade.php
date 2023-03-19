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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body onload="preCarregamento();">
    <main>

    
        <div class="pre-carregamento">
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
                        <li class="nav-item">
                            <a href="/produto/adicionar" class="nav-link">Adicionar Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Entrar</a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <p>IPET DEVELOPMENT &copy; 2023</p>
        </footer>
    </main>
    <script src="/js/app.js"></script>

</body>
</html>
    

  
