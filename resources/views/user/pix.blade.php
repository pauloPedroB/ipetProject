@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')

{{-- container --}}
    <form class=" container-fluid" style="background-color: #ffff" action="/premium">
        
        <section id="content-payment">
            <div class="payment-dados">
                    <div class="pix-dados" >
                        <h1 class="title-payment">Escolha a forma de pagamento:</h1>
                        <div class="container-option">
                            <a href="/payment"><i class="fa-regular fa-credit-card"></i></a>
                            <p>Débito/Crédito</p>
                            <a href="/pix"><i class="fa-brands fa-pix" style="color: #ee5253;"></i></a>
                            <p>PIX</p>
                        </div>
                        <div class="pix-recebedor" >
                            <h2>Recebedor</h2>
                            <p>IPET</p>
                            <h2>Código pix valido até: </h2>
                            <p>23:59 horas</p>
                        </div>
                    </div>
                    <div class="pix-codigo" >
                        <span id="qrcode" class="material-symbols-outlined">qr_code_2</span>
                        <p>000232056988044775006</p>
                    </div>
            </div>
                    <div class="card-premium">
                        <img class="img-premium" src="/img/premium.png" alt="" >
                        <h2>Premium</h2>
                        <p>Descrição do Produto</p>
                        <p>Total:R$ 00,00</p>
                    </div>
        </section>
        <div class="confirmation">
            <button>Confirmar Pagamento</button>
            <p>*Aprovação imediata*</p>
        </div>
    </form>
               

    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

@endsection