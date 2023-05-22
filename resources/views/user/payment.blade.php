@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')

    {{-- container --}}
    <form class=" container-fluid" style="background-color: #ffff" action="/premium">
        
        <section id="content-payment">
            <div class="payment-dados">
                <form action="">
                    <div class="card-dados" >
                        <h1 class="title-payment">Escolha a forma de pagamento:</h1>
                        <div class="container-option">
                            <a href="/payment"><i class="fa-regular fa-credit-card" style="color: #ee5253;"></i></a>
                            <p>Débito/Crédito</p>
                            <a href="/pix"><i class="fa-brands fa-pix"></i></a>
                            <p>PIX</p>
                        </div>
                        <label for="number">Nº do Cartão</label>
                        <input type="number" name="number" placeholder="XXXX XXXX XXXX XXXX">
                        <label for="name">Nome do Titular</label>
                        <input type="text" name="name" placeholder="Maria Clara Santos">
                    </div>
                    <div class="form-card" >
                        <div class="card-dados-validity">
                            <label for="validity">Validade</label>
                            <input type="month" placeholder="00/00">
                        </div>
                        <div class="card-dados-cvv">
                            <label for="cvv">CVV</label>
                            <input type="number" name="cvv" min="3" max="3" placeholder="XXX">
                        </div>
                    </div>
                </form>
                    <div class="card-checkbox">
                        <input type="checkbox" checked>
                        <p>Desejo deixar os dados do meu cartão salvo</p>
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
            <button type="submit">Confirmar Pagamento</button>
            <p>*Aprovação imediata*</p>
        </div>
    </form>
               

    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>

@endsection
