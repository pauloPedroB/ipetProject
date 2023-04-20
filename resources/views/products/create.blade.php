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
                <h3>Descrições</h3>
                <label for="new-label-name">Digite o nome da nova Descrição:</label>
                <input type="text" id="new-label-name" class="form-control">
                <p id="errorLabel"></p>
                <a id="add-input" class="link">Adicionar Descrição</a>

                <div id="dynamic-inputs">
                    <!-- Aqui serão adicionados os novos inputs e labels -->
                </div>
                <script>
                    var count = 1;
                    document.getElementById("add-input").addEventListener("click", function() {
                       var newLabelName = document.getElementById("new-label-name").value;
                        if(newLabelName !== ''){
                            var label = document.createElement("label");
                            label.innerHTML = newLabelName + ": ";
                            label.setAttribute("id", "label-" + count);
                            label.setAttribute("name", "label-" + count);
                            label.setAttribute("class", "labels");


                            var input = document.createElement("input");
                            input.type = "text";
                            input.setAttribute("id", "label-" + count);
                            input.setAttribute("name", "label-" + count);
                            input.setAttribute("class", "form-control");

                            var container = document.getElementById("dynamic-inputs");
                            container.appendChild(label);
                            container.appendChild(input);
                            var errorLabel = document.getElementById("errorLabel");
                            errorLabel.innerHTML = '';
                            document.getElementById("new-label-name").value = "";

                            count++;
                        }
                        else{
                            var errorLabel = document.getElementById("errorLabel");
                            errorLabel.innerHTML = 'Nome da descrição não pode ser vazio';
                            errorLabel.style.color = 'red';
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
