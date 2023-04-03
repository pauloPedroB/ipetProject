@extends('layouts.main')
@section('title','Editando: ')
@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{$product->Name}}</h1>
        <form action="/produtos/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Imagem do Produto: </label>
                <input type="file" id="image" name="image" class="from-control-file" accept="image/png, image/jpeg">
                <img src="/img/products/{{$product->Image}}" alt="{{$product->Name}}" class="img-preview">
            </div>
            <div class="form-group">
                <label for="title">Nome</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome do Produto" value="{{$product->Name}}" required>
            </div>
            <div class="form-group">
                <label for="title">Descrição</label>
                <textarea type="text" class="form-control" id="Description" name="Description" placeholder="Descrição do Produto" required>{{$product->Description}}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Valor</label>
                <input type="number" class="form-control" id="Value" name="Value" placeholder="R$..." required value="{{$product->Value}}">
            </div>
            <div class="form-group">
                <label for="Especificações">Especificações</label>
                <textarea type="text" class="form-control" id="Specifications" name="Specifications" placeholder="Especificações do Produto" required>{{$product->Specifications}}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Peso</label>
                <input type="number" class="form-control" id="Weight" name="Weight" placeholder="" value="{{$product->Weight}}" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Adicionar Produtos">
        </form>
    </div>
@endsection