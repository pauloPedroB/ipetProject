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
                    <div class="rounded-5 icon-link icon-link-hover" style="width: 20rem; height:max-content; background-color: #DBF0E1;">
                        <img class="img-fluid" src="/img/gratuito.png" alt="" id="nav-free">
                        <h2 class="fs-3 fw-bold flex-column pb-3" style="margin-top:2rem">Gratuito</h2>
                        <h3 class="fs-3 fw-bold  flex-column pb-3">Benefícios:</h3>
                    </div>
                </a>
            </div>

            {{-- card-user --}}
            <div class=" col-auto card-user flex-column  text-center m-5">
                <a class="btn" href="/premium">
                    <div class="rounded-5" style="width: 20rem; height:max-content; background-color: #DBF0E1">
                        <img class="img-fluid" src="/img/premium.png" alt="" id="nav-premium">
                        <h2 class="fs-3 fw-bold  flex-column pb-3" style="margin-top:2rem">Premium</h2>
                        <h3 class="fs-3 fw-bold  flex-column pb-3">Benefícios:</h3>
                    </div>
                </a>
            </div>


        </div>

    </div>


</div>

</div>


@endsection
