@extends('layouts.main')
@section('title','Cadastrar Endereço')
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Adicionar produtos</h1>
        <div id="message">
            <p>oi</p>
        </div>
        <form action="/Endereco/Cadastrar" method="POST" enctype="multipart/form-data" id="addres">
            @csrf
            <div class="form-group">
                <label for="title">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="Seu CEP..." maxlength="8" required>
                <input type="button" class="btn btn-primary" value="Buscar Endereço">
            </div>
            <div class="form-group">
                <label for="title">Rua:</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Sua Rua..." required>
            </div>
            <div class="form-group">
                <label for="title">Número</label>
                <input type="number" class="form-control" id="Number" name="Number" required>
            </div>
            <div class="form-group">
                <label for="title">Bairro:</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Seu bairro..." required>
            </div>
            <div class="form-group">
                <label for="title">Cidade</label>
                <textarea type="text" class="form-control" id="city" name="city" placeholder="Sua Cidade..." required></textarea>
            </div>
            <div class="form-group">
                <label for="title">Estado</label>
                <select name="uf" id="uf"class="form-control" type="select" disabled required data-input>
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
            <input type="submit" class="btn btn-primary" value="Adicionar Produtos">
        </form>
    </div>
@endsection
