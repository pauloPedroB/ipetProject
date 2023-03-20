@extends('layouts.main')
@section('title','Adicionar Produto')
@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Adicionar produtos</h1>
        <form action="/produto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Imagem do Produto: </label>
                <input type="file" id="image" name="image" class="from-control-file">
            </div>
            <div class="form-group">
                <label for="title">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Produto" required>
            </div>
            <div class="form-group">
                <label for="title">Descrição</label>
                <textarea type="text" class="form-control" id="descrition" name="descrition" placeholder="Descrição do Produto" required></textarea>
            </div>
            <div class="form-group">
                <label for="title">Valor</label>
                <input type="number" class="form-control" id="preco" name="preco" placeholder="R$..." required>
            </div>
            <input type="submit" class="btn btn-primary" value="Adicionar Produtos">
        </form>
    </div>
@endsection