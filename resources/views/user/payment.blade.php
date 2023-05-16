@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')


{{-- container --}}
<div class=" container-fluid" style="background-color: #ffff">

    <h1>Escolha a forma de pagamento:</h1>
    <div class="container-option">
        <input type="checkbox" checked>
        <i class="fa-regular fa-credit-card"></i>
        <input type="checkbox" checked>
        <i class="fa-brands fa-pix"></i>
        <p>Débito/Crédito</p>
    </div>
    <div>
        <form action="">
            <label for="number">Nº do Cartão</label>
            <input type="number" name="number" placeholder="XXXX XXXX XXXX XXXX">
            <label for="name">Nome do Titular</label>
            <input type="text" name="name">
            <div>
                <label for="validity">Validade</label>
                <input type="month" placeholder="00/00">
                <label for="cvv"></label>
                <input type="number" name="cvv" min="3" max="3" placeholder="XXX">
            </div>
            <div>
                <input type="checkbox" checked>
                <p>Desejo deixar os dados do meu cartão salvo</p>
            </div>
            <div>
                <img class="img-fluid" src="/img/premium.png" alt="" >
                <h2>Premium</h2>
                <p>Descrição do Produto</p>
                <p>Total:R$ 00,00</p>
            </div>
            <button>Confirmar Pagamento</button>
            <p>*Aprovação imediata*</p>
        </form>
    </div>
</div>
<script src="https://kit.fontawesome.com/02020a9349.js" crossorigin="anonymous"></script>

@endsection
