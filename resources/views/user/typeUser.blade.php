@extends('layouts.main')
@section('titlle', 'Tipo de Usuário')
@section('content')
    <div id="container" class="col m-5 p-5 card d-flex flex-column text-center w-75 h-50">

        <h1>Você deseja se cadastrar como:</h1>
        <div class=" card d-flex flex-row m-5 p-5 justify-content-center">


            <div class="btn cardLoja card d-inline-flex p-2 m-5 p-5 ">
                <a href="/Registra/Loja"><span class="material-symbols-outlined">store</span></a>
                <div class="card-body">
                    <p class="fs-1">Loja</p>
                </div>
            </div>


            <div class="btn cardUsuario card d-inline-flex p-2 m-5 p-5">
                <a href="/Registra/Usuario"><span class="material-symbols-outlined">person</span></a>
                <div class="card-body">
                    <p class="fs-1">Usuário</p>
                </div>
            </div>
        </div>

    </div>
@endsection
