@extends('layouts.main')
@section('titlle', 'Tipo de Acesso')
@section('content')


{{-- container --}}
<div class=" container-fluid" style="background-color: #ffff">


    <div class="row " style="margin: 0">
        
        {{-- tittle --}}
        <div class="p-5" style="color:#F29200; width: ">
            <h1 class="">Escolha um pacote</h1>
        </div>

        <div class="d-flex flex-row mt-1 flex-wrap justify-content-around">
            {{-- card-market --}}
            <div class="col-auto card-market flex-column text-center m-5 ">
                <a class="btn" href="/">
                    <div class="rounded-5 p-3" style="width: 20rem; height:max-content; background-color: #DBF0E1;">
                        <img class="img-fluid mt-2" src="/img/gratuito.png" alt="" id="nav-free">
                        <h2 class="fs-4 fw-bold flex-column pb-3" style="margin-top:2rem">Gratuito</h2>
                        <p class="fs-6">Seus produtos aparecerão para os clientes por ordem de proximidade</p>
                    </div>
                </a>
            </div>

            {{-- card-user --}}
            <div class=" col-auto card-user flex-column  text-center m-5">
                <a class="btn" href="/payment">
                    <div class="rounded-5 p-3" style="width: 20rem; height:max-content; background-color: #DBF0E1">
                        <img class="img-fluid" src="/img/premium.png" alt="" id="nav-premium" >
                        <h2 class="fs-4 fw-bold  flex-column pb-3" style="margin-top:2rem">Premium</h2>
                        <p class="fs-6">Seus produtos aparecerão primeiro para os clientes em relação as outras lojas!</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


</div>

</div>


@endsection
