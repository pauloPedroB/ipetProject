@extends('layouts.main')
@section('title','Editar Dados')
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <div id="header_form" class="d-flex flex-column flex-md-row align-items-center">
            @if($user->AL_id == 2)
                <i class=" col fa-solid fa-city  d-flex justify-content-center align-items-center m-2" id="icon_register"></i>
                <h1 class="fs-2 m-4">Editando - {{$registro->Nome}}</h1>
            @else
                <i class=" col fa-solid fa-user  d-flex justify-content-center align-items-center m-2" id="icon_register"></i>
                <h1 class="fs-2 m-4">Editando - {{$registro->Name}}</h1>
            @endif
        </div>
        <form class="d-flex flex-column flex-md-row align-items-baseline w-100 p-2 bs-light-rgb" action="/Update/Loja/{{$registro->id}}" method="POST" enctype="multipart/form-data" id="addres">
            @csrf
            @method('PUT')
            <div class="container-fluid " id="container-register">
                {{-- formulario  --}}
                        
                <div class="form-group">

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <label for="" id="error-message">{{ session('status') }}</label>
                        </div>
                    @endif
                    @if($user->AL_id == 2)
                        <label class="form-label"  for="cnpj">CNPJ:</label>
                        <input class="form-control" type="text" name="cnpj" id="cnpj" class="" placeholder="00.000.000/0000-00" value ="{{$registro->CNPJ}}" disabled>
                        
                        <label class="form-label" for="razaoSocial">Razão social ou Nome completo</label>
                        <input  class="form-control" type="text" id="razaoSocial" name="razaoSocial" value ="{{$registro->Razao}}" required>
                        
                        <label class="form-label" for="nomeFantasia">Nome Fantasia:</label>
                        <input class="form-control" type="text" id="nomeFantasia" name="nomeFantasia" value ="{{$registro->Nome}}" required>
                    
                        <label class="form-label"  for="telefone">Telefone:</label>
                        <input class="form-control" type="tel" id="telefone" name="telefone" value ="{{$registro->Telefone}}"required>
                        
                        <label class="form-label" for="celular">Celular:</label>
                        <input class="form-control" type="tel" id="celular" name="celular" value ="{{$registro->Celular}}"required>
                    @else
                        <label class="form-label"  for="cnpj">CPF:</label>
                        <label for="" id="error-message"></label>
                        <input class="form-control" type="text" name="CPF" id="CPF" class="" value="{{$registro->CPF}}" placeholder="__.___.___/____-__" disabled >
                        
                        <label class="form-label" for="nomeFantasia">Nome</label>
                        <input class="form-control" type="text" id="Name" name="Name" value="{{$registro->Name}}" required>
                        
                        <label class="form-label"  for="telefone">Telefone:</label>
                        <input class="form-control" type="tel" id="telefone" name="telefone" value="{{$registro->Telefone}}" required>
                        
                        <label class="form-label" for="celular">Celular:</label>
                        <input class="form-control" type="tel" id="celular" name="celular" value="{{$registro->Celular}}" required>

                        <label class="form-label" for="">Data de Nascimento:</label>
                        <input type="date" name="DT" id="DT" value="{{$registro->DT}}" disabled>

                        <br>
                    @endif
                    <label class="form-label" for="title">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="Seu CEP..." value="{{$endereco->CEP}}" maxlength="8" required>
                </div>
                    
            </div>

            <div class="container-fluid " id="container-register">
            
                <div class="form-group">
                
                    <label class="form-label" for="title">Rua:</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Sua Rua..." value="{{$endereco->Logradouro}}" required>
                
                    <label class="form-label" for="title">Número</label>
                    <input type="number" class="form-control" id="Number" name="Number" value="{{$endereco->Numero}}" required>
                
                    <label class="form-label" for="title">Bairro:</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Seu bairro..." value="{{$endereco->Bairro}}" required>
                
                    <label class="form-label" for="title">Cidade</label>
                    <textarea type="text" class="form-control" id="city" name="city" placeholder="Sua Cidade..." required>
                        {{$endereco->Cidade}}
                    </textarea>
                
                    <label class="form-label" for="title">Estado</label>
                    <select name="uf" id="uf"class="form-control" type="select" value="{{$endereco->UF}}" required data-input>
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
                    
                    <div class="d-none">
                        <label for="title">Latitude</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Sua Latitude..." value="{{$endereco->Latitude}}">
                    
                        <label for="title">Latitude</label>
                        <input type="text" class="form-control" id="long" name="long" placeholder="Sua Longitude..." value="{{$endereco->Longitude}}">
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <button type="submit" class="btn btn-primary m-2" id="btnCadastro">Registrar</button>
                    <a href="/dashboard" class="btn btn-danger m-2" id="btnCadastro">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <script>
    
    var celularInput = document.getElementById('celular');

    celularInput.addEventListener('input', function() {
      var celular = celularInput.value;
      var regex = /^\(\d{2}\)\s?\d{5}-\d{4}$/;
      
      if (!regex.test(celular)) {
        celularInput.setCustomValidity('Informe um número de celular válido no formato (XX) XXXXX-XXXX.');
      } else {
        celularInput.setCustomValidity('');
      }
    });
    
    const form = document.getElementById("addres");
    
    form.addEventListener("submit", function(event)
    {
        event.preventDefault();
        
        const msg = document.getElementById('error-message');
        const latInput = document.getElementById('lat');
        const longInput = document.getElementById('long');
        
        const api_key = 'AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4';
        fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cepInput.value} ${numberInput.value},${cepInput.value}&key=${api_key}`)
        .then(response => response.json())
        .then(data => {
            const location = data.results[0].geometry.location;
            const latitude = location.lat;
            const longitude = location.lng;
            console.log(location.lat);
           
            if(latitude == null){
              latitude = '-23.61279792090457';
            }
            if(longitude == null){
              longitude = '-46.780145384505474';
            }
            latInput.value = latitude;
            longInput.value = longitude;
            return form.submit();
        })
        .catch(error => {
          latInput.value = '-23.61279792090457';
          longInput.value = '-46.780145384505474';
          return form.submit();
        });

        const toggleMessage =(msg)=>{
            const messageElement = document.querySelector("#message p");
            messageElement.style.backgroundColor = 'red';
            messageElement.innerText = msg;
        }
       

    });
    </script>
@endsection
