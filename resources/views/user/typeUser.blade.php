@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')



{{-- container --}}
<div id="container-change" class=" container-fluid">

    <div id="row_change" class="row" style="margin:0">
        
        {{-- tittle --}}
        <div class="p-5" style="color: #f29200">
            <h1>Cadastre-se como:</h1>     
        </div>

        <div class="d-flex flex-row mt-1 flex-wrap justify-content-around">
            {{-- card-market --}}
            <div class="col-auto card-market flex-column text-center m-5 ">
                <a class="btn" href="/Registrar/Loja" >
                    <div class="rounded-5 p-2" id="card_store">
                        <span class="material-symbols-outlined mt-2">store</span>
                        <h2 class="fs-2 fw-bold flex-column pb-3">Loja</h2>
                    </div>
                </a>
            </div>

            {{-- card-user --}}
            <div class=" col-auto flex-column  text-center">
                <a class="btn" href="/Registrar/Usuario">
                    <div class="cards">
                        <span id="icon_user" class="material-symbols-outlined">person</span>
                        <h2 id="title_user" class="fs-3 fw-bold  flex-column pb-4" style="">Cliente</h2>
                    </div>
                </a>
            </div>


        </div>

    </div>


</div>

</div>


@endsection
