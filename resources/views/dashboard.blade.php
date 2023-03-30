@extends('layouts.main')
@section('title','Dasboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-products-container">
    @if(count($products)>0)
    @else
    <p>Você ainda não tem produtos cadastrados, <a href="/products/create">adicionar produto</a></p>
    @endif

</div>
@endsection