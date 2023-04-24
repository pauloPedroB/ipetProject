@extends('layouts.main')
@section('title','Adicionar c')
@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        @if($User->Endereco_id != null || $User->AL_id ==3)
            <h1>Adicionar Categoria</h1>
            <form action="/categoria" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Nome da Categoria</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome da Categoria" required>
                </div>
                <div class="form-group">
                    <label for="title">Descrição</label>
                    <input type="text" class="form-control" id="Description" name="Description" placeholder="Descrição da Categoria" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Adicionar Categoria">
            </form>
        @else
            <h2>CADASTRE UM ENDEREÇO ANTES DE CADASTRAR UMA CATEGORIA</h2>
        @endif
    </div>
@endsection
