@extends('layouts.main')
@section('title', 'Tipo de Usuário')
@section('content')



{{-- container --}}
<div class=" container-fluid">

    <div id="row_change" class="row">
        
        {{-- tittle --}}
        <div id="title_change">
            <h1>Cadastre-se como:</h1>
            
        </div>


        <div class="d-flex flex-row mt-1 flex-wrap justify-content-around">
            {{-- card-market --}}
            <div class="col-auto flex-column text-center ">
                <a class="btn" href="/Registrar/Loja" >
                    <div class="card">
                        <span id="icon_store" class="material-symbols-outlined">store</span>
                        <h2 id="title_store" class="fs-2 fw-bold flex-column pb-4">Loja</h2>
                    </div>
                </a>
            </div>

            {{-- card-user --}}
            <div class=" col-auto flex-column  text-center">
                <a class="btn" href="/Registrar/Usuario">
                    <div class="card">
                        <span id="icon_user" class="material-symbols-outlined">person</span>
                        <h2 id="title_user" class="fs-3 fw-bold  flex-column pb-3" style="">Cliente</h2>
                    </div>
                </a>
            </div>


        </div>

    </div>


</div>

</div>


@endsection
