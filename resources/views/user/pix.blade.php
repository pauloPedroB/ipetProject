@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')

{{-- container --}}
    <div class=" container" style="background-color: #ffff">
        <section class="content-payment">
            <div class="card-premium">
                <img class="img-premium" src="/img/premium.png" alt="" >
                <h2>Premium</h2>
                <p>Seus produtos terão prioridade na divulgação!</p>                        
                <p>Total:R$ 00,00</p>
            </div>
            <div class="payment-dados">
                    <div class="pix-dados" >
                        <h1 class="title-payment">Escolha a forma de pagamento:</h1>
                        <div class="container-option">
                            <a href="/payment"><i class="fa-regular fa-credit-card"></i></a>
                            <p>Débito/Crédito</p>
                            <a href="/pix"><i class="fa-brands fa-pix" style="color: #1db844;"></i></a>
                            <p>PIX</p>
                        </div>
                        <div class="pix-recebedor" >
                            <h2>Quem recebe:</h2>
                            <p>IPET Serviços LTDA.</p>
                            <h2>Código pix valido até: </h2>
                            <p>23:59 horas</p>
                        </div>
                    </div>
                    <div class="pix-codigo" >
                        <span id="qrcode" class="material-symbols-outlined">qr_code_2</span>
                        <p>000232056988044775006</p>
                    </div>
                   
            </div>
                  
        </section>
    </div>
               

    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

@endsection