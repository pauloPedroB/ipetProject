@extends('layouts.main')
@section('titlle','Tipo de Usuário')
@section('content')
    <div class="row" id="cards-container">

        <h1>Você deseja se cadastrar como:</h1>

        <div class="cardLoja card col-md-">
            <a href="/Registar/Loja"><span class="material-symbols-outlined img-fluid" style="width: 300px;">store</span></a>
            <p>Loja</p>
            
        </div>

        

        <div class="cardUsuario">
            <a href="/Registar/Usuario"><span class="material-symbols-outlined">person</span></a>
            <p>Usuário</p>
        </div>

    </div>
@endsection
    