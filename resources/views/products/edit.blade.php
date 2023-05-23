@extends('layouts.main')
@section('title','Editando: ')
@section('content')
    <div id="event-create-container" class="">
        @if($User->Endereco_id != null || $User->AL_id ==3)
            <h1>Editando: {{$product->Name}}</h1>
            <form id="form-products" action="/produtos/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 <div class="form-group">
                    <label for="title">Categoria: </label>
                    <select name="category" id="category" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="form-group-image">
                    <label for="title">Imagem do Produto: </label>
                    <input onchange="mostrarImagem()" type="file" id="image" name="image" class="from-control-file" accept="image/png, image/jpeg" required>
                     <div id="imageforProduct">
                        <img id="imagem-preview" src="/img/products/{{$product->Image}}" alt="Imagem selecionada" style="width: 100px;">
                    </div>
                    <script>
                        var campoImagem = document.getElementById("image");
                        inputImagem.files = [{{$product->Image}}];
                    </script>
                </div>
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome do Produto" value="{{$product->Name}}" required>
                </div>
                <h3>Adicionar descrição</h3>
                <div class="form-group d-flex justify-content-star">
                    <input type="checkbox" id="Idade"><label for="">Idade</label>
                    <input type="checkbox" id="Pet"><label for="">Pet</label>
                    <input type="checkbox" id="Porte"><label for="">Porte</label>
                    <input type="checkbox" id="Apresentacao"><label for="">Apresentação</label>
                </div>
                

                <div id="dynamic-inputs">
                    <!-- Aqui serão adicionados os novos inputs e labels -->
                    @foreach($description as $des)
                        @if (strpos($des, 'Idade: ') !== false)
                            <select name="idadeCombo" id="idadeCombo" class="form-control" required>
                                <option value="Filhote">Filhote</option>
                                <option value="Adulto">Adulto</option>
                            </select>
                            <script>
                                Idade.checked = true;
                            </script>
                        @endif
                        @if (strpos($des, 'Pet: ') !== false)
                            <select name="petCombo" id="petCombo" class="form-control" required>
                                <option value="Cachorro">Cachorro</option>
                                <option value="Gato">Gato</option>
                                <script>
                                    Pet.checked = true;
                                </script>
                            </select>
                        @endif
                        @if (strpos($des, 'Porte: ') !== false)
                            <select name="porteCombo" id="porteCombo" class="form-control" required>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Medio">Medio</option>
                                <option value="Grande">Grande</option>
                                <script>
                                    Porte.checked = true;
                                </script>
                            </select>
                        @endif
                        
                        @if (strpos($des, 'Apresentação: ') !== false)
                            <input name="Apresentacaoinput" id="Apresentacaoinput" class="form-control" type="text" placeholder="Ex: Disponível em embalagens de 3kg e 15kg" value="{{str_replace('Apresentação: ','',end($description))}}" required>
                            <script>
                                Apresentacao.checked = true;
                            </script>
                        @endif
                    @endforeach
                </div>
                <script>
                    function mostrarImagem(){
                        const input = document.getElementById('image');
                        const preview = document.getElementById('imagem-preview');
                        if (input.files && input.files[0]) {
                            
                            const url = URL.createObjectURL(input.files[0]);

                            preview.src = url;

                            preview.onload = function() {
                                URL.revokeObjectURL(url);
                            };
                        }
                    }
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
                            newComboBox.setAttribute("class", "form-control");
                            newComboBox.required = true;

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
                            newComboBox.required = true;


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
                            newComboBox.required = true;


                            var option1 = document.createElement("option");
                            option1.value = "Pequeno";
                            option1.text = "Pequeno";
                            newComboBox.add(option1);

                            var option2 = document.createElement("option");
                            option2.value = "Medio";
                            option2.text = "Médio";
                            newComboBox.add(option2);

                            var option3 = document.createElement("option");
                            option3.value = "Grande";
                            option3.text = "Grande";
                            newComboBox.add(option3);

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('porteCombo');
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
                            newComboBox.required = true;



                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(newComboBox);
                            
                        } else {
                            var newComboBox = document.getElementById('Apresentacaoinput');
                            newComboBox.remove();
                        }
                    });

                </script>
                <input type="submit" class="btn btn-primary" value="Editar Produtos">
        @else
            <h2>CADASTRE UM ENDEREÇO ANTES DE CADASTRAR UM PRODUTO</h2>
        @endif
    </div>
@endsection
