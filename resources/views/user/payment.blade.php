@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')

    {{-- container --}}
    <div class=" container" style="background-color: #ffff">
        <div id="payment">
                <section class="content-payment">
                        <div class="card-premium">
                            <img class="img-premium" src="/img/premium.png" alt="" >
                            <h2>Premium</h2>
                            <p>Seus produtos terão prioridade na divulgação!</p>
                            <p>Total:R$ 00,00</p>
                        </div>
                    <div class="payment-dados">
                        <form action="/premium">
                            <div class="card-dados" >
                                <h1 class="title-payment">Escolha a forma de pagamento:</h1>
                                <div class="container-option">
                                    <a href="/payment"><i class="fa-regular fa-credit-card" style="color: #1db844;"></i></a>
                                    <p>Débito/Crédito</p>
                                    <a href="/pix"><i class="fa-brands fa-pix"></i></a>
                                    <p>PIX</p>
                                </div>
                                <label for="number">Nº do Cartão</label>
                                <input type="text"name="card_number" pattern="[0-9]{13,16}" placeholder="XXXX XXXX XXXX XXXX"required>
                                <label for="name">Nome do Titular</label>
                                <input type="text" name="name" placeholder="Maria Clara Santos" required>
                            </div>
                            <div class="form-card" >
                                <div class="card-dados-validity">
                                    <label for="validity">Validade</label>
                                    <input type="month" placeholder="00/00" required>
                                </div>
                                <div class="card-dados-cvv">
                                    <label for="cvv">CVV</label>
                                    <input type="number" name="cvv"  maxlength="3" placeholder="XXX" required>
                                </div>
                            </div>
                            <div class="confirmation">
                                <button type="submit" name="confirmation">Confirmar Pagamento</button>
                            </div>
                        </form>
                    </div>
                  
                </section>
        </div>
    </div>
             

    <script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>

@endsection
