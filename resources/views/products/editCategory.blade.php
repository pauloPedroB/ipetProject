@extends('layouts.main')
@section('title','Editar categoria')
@section('content')
    <div id="event-create-container" class="">
        @if($User->Endereco_id != null || $User->AL_id ==3)
            <h1>Adicionar Categoria</h1>
            <form action="/categoria/editar/{{$category->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Nome da Categoria</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome da Categoria" value="{{$category->name}}" required>
                </div>
                <div class="form-group">
                    <label for="title">Descrição</label>
                    <input type="text" class="form-control" id="Description" name="Description" placeholder="Descrição da Categoria" value="{{$category->Description}}" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Adicionar Categoria">
            </form>
        @else
            <h2>CADASTRE UM ENDEREÇO ANTES DE CADASTRAR UMA CATEGORIA</h2>
        @endif
    </div>
@endsection
