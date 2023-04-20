@extends('layouts.main')
@section('title','Adicionar Produto')
@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        @if($User->Endereco_id != null || $User->AL_id ==3)
            <h1>Adicionar produtos</h1>
            <form action="/produto" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Imagem do Produto: </label>
                    <input type="file" id="image" name="image" class="from-control-file" accept="image/png, image/jpeg" required>
                </div>
                <div class="form-group">
                    <label for="title">Nome</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome do Produto" required>
                </div>
                <h3>Adicionar descrição</h3>
                <input type="checkbox" id="Idade"><label for="">Idade</label>
                <input type="checkbox" id="Pet"><label for="">Pet</label>
                <input type="checkbox" id="Porte"><label for="">Porte</label>
                <input type="checkbox" id="Tipo"><label for="">Tipo</label>
                <input type="checkbox" id="Apresentacao"><label for="">Apresentação</label>

                <p id="errorLabel"></p>
                <a id="add-input" class="link">Adicionar Descrição</a>

                <div id="dynamic-inputs">
                    <!-- Aqui serão adicionados os novos inputs e labels -->
                </div>
                <script>
                    var Idade = document.getElementById('Idade');
                    var Pet = document.getElementById('Pet');
                    var Porte = document.getElementById('Porte');
                    var Tipo = document.getElementById('Tipo');
                    var Apresentacao = document.getElementById('Apresentacao');

                    // Adicionar um evento de mudança ao checkbox
                    Idade.addEventListener('change', function() {
                        if (Idade.checked) {
                            var newComboBox = document.createElement("select");
                            newComboBox.setAttribute("id", "idadeCombo");
                            newComboBox.setAttribute("name", "idadeCombo");
                            newComboBox.setAttribute("class", "form-control");


                            var option1 = document.createElement("option");
                            option1.value = "Filhote";
                            option1.text = "Filhote";
                            newComboBox.add(option1);

                            var option2 = document.createElement("option");
                            option2.value = "Adulto";
                            option2.text = "Adulto";
                            newComboBox.add(option2);

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('idadeCombo');
                            newComboBox.remove();
                            console.log('O checkbox foi desmarcado!');
                        }
                    });
                    Pet.addEventListener('change', function() {
                        if (Pet.checked) {
                            var newComboBox = document.createElement("select");
                            newComboBox.setAttribute("id", "petCombo");
                            newComboBox.setAttribute("name", "petCombo");
                            newComboBox.setAttribute("class", "form-control");


                            var option1 = document.createElement("option");
                            option1.value = "Cachorro";
                            option1.text = "Cachorro";
                            newComboBox.add(option1);

                            var option2 = document.createElement("option");
                            option2.value = "Gato";
                            option2.text = "Gato";
                            newComboBox.add(option2);

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('petCombo');
                            newComboBox.remove();
                        }
                    });
                    Porte.addEventListener('change', function() {
                        if (Porte.checked) {
                            var newComboBox = document.createElement("select");
                            newComboBox.setAttribute("id", "porteCombo");
                            newComboBox.setAttribute("name", "porteCombo");
                            newComboBox.setAttribute("class", "form-control");


                            var option1 = document.createElement("option");
                            option1.value = "Pequeno";
                            option1.text = "Pequeno";
                            newComboBox.add(option1);

                            var option2 = document.createElement("option");
                            option2.value = "Medio";
                            option2.text = "Médio";
                            newComboBox.add(option2);

                            var option3 = document.createElement("option");
                            option2.value = "Grande";
                            option2.text = "Grande";
                            newComboBox.add(option3);

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('porteCombo');
                            newComboBox.remove();
                        }
                    });

                    Tipo.addEventListener('change', function() {
                        if (Tipo.checked) {
                            var newComboBox = document.createElement("select");
                            newComboBox.setAttribute("id", "tipoCombo");
                            newComboBox.setAttribute("name", "tipoCombo");
                            newComboBox.setAttribute("class", "form-control custom-select");


                            var option1 = document.createElement("option");
                            option1.value = "Alimentação";
                            option1.text = "Alimentação";
                            newComboBox.add(option1);

                            var option2 = document.createElement("option");
                            option2.value = "Cuidados";
                            option2.text = "Cuidados";
                            newComboBox.add(option2);

                            var option3 = document.createElement("option");
                            option2.value = "Acessórios";
                            option2.text = "Acessórios";
                            newComboBox.add(option3);

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('tipoCombo');
                            newComboBox.remove();
                        }
                    });

                    Apresentacao.addEventListener('change', function() {
                        if (Apresentacao.checked) {
                            var newComboBox = document.createElement("input");
                            newComboBox.setAttribute("id", "Apresentacaoinput");
                            newComboBox.setAttribute("name", "Apresentacaoinput");
                            newComboBox.setAttribute("class", "form-control");
                            newComboBox.setAttribute("type", "text");
                            newComboBox.setAttribute("placeholder", "Ex: Disponível em embalagens de 3kg e 15kg");



                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('Apresentacaoinput');
                            newComboBox.remove();
                        }
                    });

                </script>
                <input type="submit" class="btn btn-primary" value="Adicionar Produtos">
            </form>
        @else
            <h2>CADASTRE UM ENDEREÇO ANTES DE CADASTRAR UM PRODUTO</h2>
        @endif
    </div>
@endsection
