@extends('layouts.main')
@section('titlle', 'Tipo de Usuário')
@section('content')
    <div id="container" class="col m-5 p-5 card d-flex flex-column text-center w-75 h-50">

        <h1 class="text-left">Você deseja se cadastrar como:</h1>
        <div class=" card d-flex flex-row m-5 p-5 justify-content-center">

        <a href="/Registrar/Loja">
            <div class="btn cardLoja card d-inline-flex p-2 m-5 p-5 ">
                <img class="img-fluid" class="img-thumbnail"src="/img/store_img.png" alt="" style="width: 10vw; height:15vh">
                <div class="card-body">
                </div>
            </div>
        </a>

        <a href="/Registrar/Usuario">
            <div class="btn cardUsuario card d-inline-flex p-2 m-5 p-5">
                <img class="img-fluid" src="/img/user_img.png" alt="" style="width: 10vw; height: 15vh">
                <div class="card-body">
                </div>
            </div>
        </a>
        </div>

    </div>
@endsection
