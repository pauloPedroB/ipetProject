@extends('layouts.main')
@section('title', 'Adicionar categoria')
@section('content')
    <div id="event-create-container">
        @if ($User->Endereco_id != null || $User->AL_id == 3)
            <h1>Adicionar Categoria</h1>
            <form action="/categoria" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Nome da Categoria:</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nome da Categoria"
                        required>
                </div>

                {{-- deletar form (não precisa mais) --}}

                <input type="submit" class="btn btn-primary" value="Adicionar Categoria">
            </form>
        @else
            <h2>CADASTRE UM ENDEREÇO ANTES DE CADASTRAR UMA CATEGORIA</h2>
        @endif
    </div>
@endsection
