@extends('layouts.main')
@section('title','Cadastrar Endereço')
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        @foreach($Enderecos as $Endereco)
            @if($User->Endereco_id == $Endereco->id)
                    @php
                        $Logradouro = $Endereco->Logradouro;
                        $CEP = $Endereco->CEP;
                        $Bairro = $Endereco->Bairro;
                        $Cidade = $Endereco->Cidade;
                        $Numero = $Endereco->Numero;
                        $Latitude = $Endereco->Latitude;
                        $Longitude = $Endereco->Longitude;
                        $UF = $Endereco->UF;
                        $title = 'Editar Endereço';
                    @endphp
                @break
            @endif
        @endforeach
        <h1>{{$title}}</h1>

        <div class="container-fluid " id="container-register">
            <div id="header_form" class="row">
                <h1 class="col" id="h1_register" >Cadastro - Pessoa Jurídica</h1>
                <i class="fa-solid fa-city col d-flex justify-content-end align-items-center" id="icon_register"></i>
            </div>
            {{-- formulario  --}}
            <form action="" id="formulario">
                    
                <div class="form-group">
                    
                    <label class="form-label" for="razaoSocial">Razão social ou Nome completo</label>
                    <input class="form-control" type="text" id="razaoSocial" >
                    
                    <label class="form-label" for="nomeFantasia">Nome Fantasia:</label>
                    <input class="form-control" type="text" id="nomeFantasia" >
                    
                    <label class="form-label"  for="cnpj">CNPJ:</label>
                    <input class="form-control" type="text" name="cnpj" class="" placeholder="00.000.000/0000-00" >
                    
                    <label class="form-label"  for="telefone">Telefone:</label>
                    <input class="form-control" type="tel" id="telefone" name="telefone">
                    
                    <label class="form-label" for="celular">Celular:</label>
                    <input class="form-control" type="tel" id="celular" name="celular">
                    
                    <input class="btn btn-primary" type="submit" name="btn-enviar" value="cadastre-se"> 
                </div>
                
            </form>
        
    </div>



        <div id="message">
            <p></p>
        </div>
        <form action="/Endereco/Cadastrar" method="POST" enctype="multipart/form-data" id="addres">
            @csrf
            <div class="form-group">
                <label for="title">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="Seu CEP..." value="{{$CEP}}" maxlength="8" required>
            </div>
            <div class="form-group">
                <label for="title">Rua:</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Sua Rua..." value="{{$Logradouro}}" required>
            </div>
            <div class="form-group">
                <label for="title">Número</label>
                <input type="number" class="form-control" id="Number" name="Number" value="{{$Numero}}" required>
            </div>
            <div class="form-group">
                <label for="title">Bairro:</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Seu bairro..." value="{{$Bairro}}" required>
            </div>
            <div class="form-group">
                <label for="title">Cidade</label>
                <textarea type="text" class="form-control" id="city" name="city" placeholder="Sua Cidade..." required>
                    {{$Cidade}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="title">Estado</label>
                <select name="uf" id="uf"class="form-control" type="select" value="{{$UF}}" disabled required data-input>
                    <option selected>Estado</option>
                    <option value="AL">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Latitude</label>
                <input type="text" class="form-control" id="lat" name="lat" placeholder="Sua Latitude..." value="{{$Latitude}}" required>
            </div>
            <div class="form-group">
                <label for="title">Latitude</label>
                <input type="text" class="form-control" id="long" name="long" placeholder="Sua Longitude..." value="{{$Longitude}}" required>
            </div>
            <input type="submit" class="btn btn-primary" value="{{$title}}" id="mndEndereco">
        </form>
    </div>
@endsection
