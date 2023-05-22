@extends('layouts.main')
@section('title','Cadastrar Endereço')
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <div id="header_form" class="d-flex flex-column flex-md-row align-items-center">
            <i class=" col fa-solid fa-city  d-flex justify-content-center align-items-center" id="icon_register"></i>
            <h1 class="fs-2 m-3">Cadastro - Pessoa Jurídica</h1>
        </div>
        <form class="d-flex flex-column flex-md-row align-items-baseline w-100 p-2 bs-light-rgb" action="/Cadastrar/Loja" method="POST" enctype="multipart/form-data" id="addres">
            @csrf
            
            <div class="container-fluid" id="container-register">
                
                {{-- formulario  --}}
                        
                <div class="form-group ">

                    <label class="form-label"  for="cnpj">CNPJ:</label>
                    @if (session('error'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <label for="" id="error-message">{{ session('error') }}</label>
                        </div>
                    @endif
                    <label for="" id="error-message"></label>
                    <input class="form-control" type="text" name="cnpj" id="cnpj" class="" placeholder="00.000.000/0000-00"required >
                    
                    <label class="form-label" for="razaoSocial">Razão social ou Nome completo</label>
                    <input  class="form-control" type="text" id="razaoSocial" name="razaoSocial" required>
                    
                    <label class="form-label" for="nomeFantasia">Nome Fantasia:</label>
                    <input class="form-control" type="text" id="nomeFantasia" name="nomeFantasia" required>
                
                    <label class="form-label"  for="telefone">Telefone:</label>
                    <input class="form-control" type="tel" id="telefone" name="telefone"required>
                    
                    <label class="form-label" for="celular">Celular:</label>
                    <input class="form-control" type="tel" id="celular" name="celular"required>
                    
                    <label class="form-label" for="title">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="Seu CEP..." value="" maxlength="8" required>
                </div>
            </div>


            <div class="container-fluid" id="container-register">
                <div class="form-group">

                    <label class="form-label" for="title">Rua:</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Sua Rua..." value="" required>
                
                    <label class="form-label" for="title">Número</label>
                    <input type="number" class="form-control" id="Number" name="Number" value="" required>
                
                    <label class="form-label" for="title">Bairro:</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Seu bairro..." value="" required>
                
                    <label class="form-label" for="title">Cidade</label>
                    <textarea type="text" class="form-control" id="city" name="city" placeholder="Sua Cidade..." required>
                    </textarea>

                    <label class="form-label" for="title">Estado</label>
                    <select name="uf" id="uf"class="form-control" type="select" required data-input>
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
                        
                        <label class="form-label" for="title">Latitude</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Sua Latitude..."  disabled>

                        <label class="form-label" for="title">Latitude</label>
                        <input type="text" class="form-control" id="long" name="long" placeholder="Sua Longitude..."  disabled>
                    
                    </div>
                
                </div> 
                <div class="d-flex flex-row">
                    <button type="submit" class="btn btn-primary m-2" id="btnCadastro">Registrar</button>
                    <a href="/Tipo/Usuario" class="btn btn-danger m-2" id="btnCadastro">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        const cnpj = document.getElementById("cnpj");
       
        cnpj.addEventListener('blur', function() {
            const URL_BASE = 'https://api-publica.speedio.com.br/buscarcnpj?cnpj='+cnpj.value;
            fetch(URL_BASE)
                .then(response=>response.json())
                .then(data=>{
                    const razao = document.getElementById("razaoSocial");
                    const nome = document.getElementById("nomeFantasia");
                    const telefone = document.getElementById("telefone");
                    const celular = document.getElementById("celular");
    
                    razao.value = data['RAZAO SOCIAL'];
                    nome.value = data['NOME FANTASIA'];
                    telefone.value = data['DDD']+data['TELEFONE'];
                    celular.value = data['DDD']+data['TELEFONE'];
                    console.log(data);
                    return;
                })
                .catch(error=>{
                    console.error('Erro: '.error);
                    return;
                });
                return;
        });
        const form = document.getElementById("addres");
    form.addEventListener("submit", function(event)
    {
        event.preventDefault();
        const cep = cepInput.value.replace(/\D/g, '');
    
        const apiURL = `https://viacep.com.br/ws/${cep}/json/`;

        try {
          const response = await fetch(apiURL);
          const data = await response.json();
          if (data.erro === true) {
            cepInput.value = "";
            toggleMessage('CEP INVÁLIDO!!');
          } else {
            addressInput.value = data.logradouro;
            neighborhoodInput.value = data.bairro;
            cityInput.value = data.localidade;
            ufInput.value = data.uf;
          }
        } catch (error) {
          console.error(error);
        }
        const msg = document.getElementById('error-message');
        const cnpj = document.getElementById('cnpj').value.replace(/[^\d]+/g,'');

        if (cnpj == '') {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        if (cnpj.length != 14) {
            msg.innerText = 'CNPJ INVÁLIDO!!';
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        // Validação do primeiro dígito verificador
        let soma = 0;
        let multiplicador = 2;

        for (let i = 11; i >= 0; i--) {
            soma += parseInt(cnpj.charAt(i)) * multiplicador;
            multiplicador = multiplicador == 9 ? 2 : multiplicador + 1;
        }

        const resto = soma % 11;
        const digitoVerificador1 = resto < 2 ? 0 : 11 - resto;

        if (parseInt(cnpj.charAt(12)) != digitoVerificador1) {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        // Validação do segundo dígito verificador
        soma = 0;
        multiplicador = 2;

        for (let i = 12; i >= 0; i--) {
            soma += parseInt(cnpj.charAt(i)) * multiplicador;
            multiplicador = multiplicador == 9 ? 2 : multiplicador + 1;
        }

        const digitoVerificador2 = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if (parseInt(cnpj.charAt(13)) != digitoVerificador2) {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }
        document.getElementById("cnpj").readOnly = true;
        if(document.getElementById("nomeFantasia").length < 7){
            msg.innerText = 'NOME INVÁLIDO!!'
            document.getElementById("name").style.color = 'red';
            return msg.style.color='red';
        }
        document.getElementById('lat').disabled = false;
        document.getElementById('long').disabled = false;

        
        const api_key = 'AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4';
        fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cepInput.value} ${numberInput.value},${cep}&key=${api_key}`)
        .then(response => response.json())
        .then(data => {
            const location = data.results[0].geometry.location;
            const latitude = location.lat;
            const longitude = location.lng;
           
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
