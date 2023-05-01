@extends('layouts.main')
@section('titlle', 'Tipo de Usuário')
@section('content')


{{-- container --}}
<div class=" container-fluid" style="background-color: #ffff">


    {{-- tittle --}}
    <div class="row justify-content-center align-items-center vh-100">

        <div class="h1 mb-1" style="color:#F29200">
            Você deseja se cadastrar como:
        </div>

        <div class="d-flex flex-row mt-1 flex-wrap justify-content-around">
            {{-- card-market --}}

            <div class="col-auto card-market flex-column text-center m-2 ">
                <a class="btn" href="/Registrar/Loja">
                    <div class="rounded-5 " style="width: 15rem; height:max-content; background-color: #DBF0E1">
                        <i class=" fa-solid fa-shop" style="font-size: 8rem; margin-top:3rem;"></i>
                        <h2 class="fs-3 fw-bold flex-column pb-3" style="margin-top:2rem">Loja</h2>
                    </div>
                </a>
            </div>

            {{-- card-user --}}

            <div class=" col-auto card-user flex-column  text-center m-2">
                <a class="btn" href="/Registrar/Usuario">
                    <div class="rounded-5" style="width: 15rem; height:max-content; background-color: #DBF0E1">
                        <i class="fa-solid fa-user" style="font-size: 8rem; margin-top:3rem;"></i>
                        <h2 class="fs-3 fw-bold  flex-column pb-3" style="margin-top:2rem">Cliente</h2>
                    </div>
                </a>
            </div>


        </div>

    </div>


</div>

</div>


@endsection
