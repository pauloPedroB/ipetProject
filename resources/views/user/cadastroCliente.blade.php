@extends('layouts.main')
@section('title','Cadastrar Endereço')
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        
        <div id="header_form" class="d-flex flex-column flex-md-row align-items-center">
            <i class=" col fa-solid fa-city  d-flex justify-content-center align-items-center" id="icon_register"></i>
            <h1 class="fs-2 m-3">Cadastro - Pessoa Física</h1>
        </div>
        <form class="d-flex flex-column flex-md-row align-items-center" action="/Cadastrar/Usuario" method="POST" enctype="multipart/form-data" id="addres">
            @csrf
            <div class="container-fluid " id="container-register">
                
                {{-- formulario  --}}
                        
                    <div class="form-group">
                        <label class="form-label"  for="cnpj">CPF:</label>
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                <label for="" id="error-message">{{ session('status') }}</label>
                            </div>
                        @endif
                        <label for="" id="error-message"></label>
                        <input class="form-control" type="text" name="CPF" id="CPF" class="" placeholder="__.___.___/____-__"required >
                        
                        <label class="form-label" for="nomeFantasia">Nome</label>
                        <input class="form-control" type="text" id="Name" name="Name" required>
                        
                        <label class="form-label"  for="telefone">Telefone:</label>
                        <input class="form-control" type="tel" id="Telefone" name="Telefone"required>
                        
                        <label class="form-label" for="celular">Celular:</label>
                        <input class="form-control" type="tel" id="Celular" name="Celular"required>

                        <label for="">Data de Nascimento:</label>
                        <input type="date" name="DT" id="DT" required>
                    </div>
                    
            
            </div>


            <div class="container-fluid " id="container-register">
                <div id="message">
                    <p></p>
                </div>
                    <div class="form-group">
                        <label for="title">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="Seu CEP..."  maxlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Rua:</label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Sua Rua..."  required>
                    </div>
                    <div class="form-group">
                        <label for="title">Número</label>
                        <input type="number" class="form-control" id="Number" name="Number"  required>
                    </div>
                    <div class="form-group">
                        <label for="title">Bairro:</label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Seu bairro..."  required>
                    </div>
                    <div class="form-group">
                        <label for="title">Cidade</label>
                        <textarea type="text" class="form-control" id="city" name="city" placeholder="Sua Cidade..." required>
                           
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Estado</label>
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
                    </div>
                    <div class="form-group">
                        <label for="title">Latitude</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Sua Latitude..." disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Latitude</label>
                        <input type="text" class="form-control" id="long" name="long" placeholder="Sua Longitude..." disabled>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Registrar" id="mndEndereco">
            </div>
        </form>
    </div>
    <script>
    var input = document.getElementById("CPF");
    
    input.addEventListener("keydown", function(event) {
        // Permite apenas números
        if (!((event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || 
            event.keyCode == 13 || event.keyCode == 27 || 
            event.keyCode == 46 || event.keyCode == 110 || 
            event.keyCode == 190)) {
            event.preventDefault();
        }
    });
    const form = document.getElementById("addres");
    form.addEventListener("submit", function(event)
    {
        event.preventDefault();
        const msg = document.getElementById('error-message');
        const cpf = document.getElementById('CPF').value;

        let soma = 0;
        let resto;

        if (cpf == "000.000.000-00" || cpf == "111.111.111-11" || cpf == "222.222.222-22" ||
            cpf == "333.333.333-33" || cpf == "444.444.444-44" || cpf == "555.555.555-55" ||
            cpf == "666.666.666-66" || cpf == "777.777.777-77" || cpf == "888.888.888-88" ||
            cpf == "999.999.999-99") {
            msg.innerText = 'CPF INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcpf').style.color='red';
            return;
        }

        for (i = 1; i <= 9; i++) {
            soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
        }
        resto = (soma * 10) % 11;

        if ((resto == 10) || (resto == 11)) {
            resto = 0;
        }

        if (resto != parseInt(cpf.substring(9, 10))) {
            msg.innerText = 'CPF INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcpf').style.color='red';
            return;
        }

        soma = 0;

        for (i = 1; i <= 10; i++) {
            soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
        }
        resto = (soma * 10) % 11;

        if ((resto == 10) || (resto == 11)) {
            resto = 0;
        }

        if (resto != parseInt(cpf.substring(10, 11))) {
            msg.innerText = 'CPF INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcpf').style.color='red';
            return;
        }
        latInput.disabled = false;
        longInput.disabled = false;

        
        const api_key = 'AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4';
        fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${addressInput.value} ${numberInput.value},${cep}&key=${api_key}`)
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
