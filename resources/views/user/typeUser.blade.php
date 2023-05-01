@extends('layouts.main')
@section('titlle', 'Tipo de Usuário')
@section('content')


    {{-- container --}}
    <div class=" container-fluid" style="background-color: #ffff">
        

        {{-- tittle --}}
        <div class="row  justify-content-center align-items-center vh-100">

            <div class="h1 d-inline-flex" style="color:#F29200"> Você deseja se cadastrar como:</div>


            {{-- card-market --}}
            <div class="col-auto card-market flex-column text-center" style="margin-right: 20rem">
                <div class="rounded-5" style="width: 15rem; height:15rem; background-color: #DBF0E1">
                    <i class=" fa-solid fa-shop" style="font-size: 8rem; margin-top:3rem;"></i>
                </div>  
                <h2 class="fs-3 fw-bold flex-column" style="margin-top:2rem">Usuário</h2>                    
            </div>
    
    
            {{-- card-user --}}
            <div class=" col-auto card-user flex-column  text-center">
                <div class="rounded-5" style="width: 15rem; height:15rem; background-color: #DBF0E1">
                    <i class="fa-solid fa-user" style="font-size: 8rem; margin-top:3rem;"></i>
                </div>
                <h2 class="fs-3 fw-bold d-flex flex-column" style="margin-top:2rem">Loja</h2>
    
            </div>

        </div>
        
    </div>


@endsection
