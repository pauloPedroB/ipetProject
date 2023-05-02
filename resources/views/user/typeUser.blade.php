@extends('layouts.main')
@section('titlle', 'Tipo de Usuário')
@section('content')


{{-- container --}}
<div class=" container-fluid" style="background-color: #ffff">


    <div class="row " style="margin: 0">
        
        {{-- tittle --}}
        <div class="p-5" style="color:#F29200; width: ">
            <h1 class="">Você deseja se cadastrar como: </h1>
        </div>

        <div class="d-flex flex-row mt-1 flex-wrap justify-content-around">
            {{-- card-market --}}
            <div class="col-auto card-market flex-column text-center m-5 ">
                <a class="btn" href="/Registrar/Loja" >
                    <div class="rounded-5 icon-link icon-link-hover" style="width: 20rem; height:max-content; background-color: #DBF0E1;">
                        <i class=" fa-solid fa-shop" style="font-size: 10rem; margin-top:3rem;"></i>
                        <h2 class="fs-3 fw-bold flex-column pb-3" style="margin-top:2rem">Loja</h2>
                    </div>
                </a>
            </div>

            {{-- card-user --}}
            <div class=" col-auto card-user flex-column  text-center m-5">
                <a class="btn" href="/Registrar/Usuario">
                    <div class="rounded-5" style="width: 20rem; height:max-content; background-color: #DBF0E1">
                        <i class="fa-solid fa-user" style="font-size: 10rem; margin-top:3rem;"></i>
                        <h2 class="fs-3 fw-bold  flex-column pb-3" style="margin-top:2rem">Cliente</h2>
                    </div>
                </a>
            </div>


        </div>

    </div>


</div>

</div>


@endsection
